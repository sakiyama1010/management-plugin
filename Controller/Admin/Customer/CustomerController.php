<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * https://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Management42\Controller\Admin\Customer;

use Eccube\Common\Constant;
use Eccube\Controller\AbstractController;
use Eccube\Repository\Master\PageMaxRepository;
use Eccube\Service\CsvExportService;
use Eccube\Util\FormUtil;

use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Plugin\Management42\Repository\Customer\CustomerEventRepository;
use Plugin\Management42\Form\Type\Admin\Customer\SearchCustomerEventType;
use Plugin\Management42\Form\Type\Admin\Customer\CustomerEventType;
use Plugin\Management42\Entity\Customer\CustomerEvent;

/**
 * 顧客コントローラークラス
 * @extends AbstractController 
 */
class CustomerController extends AbstractController
{
    /**
     * @var CsvExportService
     */
    protected $csvExportService;

    /**
     * @var PageMaxRepository
     */
    protected $pageMaxRepository;

    /**
     * @var CustomerEventRepository
     */
    protected $customerEventRepository;

    /**
     * コンストラクタ
     * @param CustomerEventRepository $customerEventRepository
     * @param PageMaxRepository $pageMaxRepository
     * @param CsvExportService $csvExportService
     */
    public function __construct(
        CustomerEventRepository $customerEventRepository,
        PageMaxRepository $pageMaxRepository,
        CsvExportService $csvExportService
    )
    {
        $this->customerEventRepository = $customerEventRepository;
        $this->pageMaxRepository = $pageMaxRepository;
        $this->csvExportService = $csvExportService;
    }

    /**
     * 顧客イベント一覧
     * @Route("/%eccube_admin_route%/customer/event", name="admin_customer_event", methods={"GET", "POST"})
     * @Route("/%eccube_admin_route%/customer/event/page/{page_no}", requirements={"page_no" = "\d+"}, name="admin_customer_event_page", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/event/index.twig")
     */
    public function eventIndex(Request $request, PaginatorInterface $paginator, $page_no = null)
    {
        $session = $this->session;

        $builder = $this->formFactory->createBuilder(SearchCustomerEventType::class);
        $searchForm = $builder->getForm();
        $pageMaxis = $this->pageMaxRepository->findAll();
        $pageCount = $session->get('eccube.admin.customer_event.search.page_count', $this->eccubeConfig['eccube_default_page_count']);
        $pageCountParam = $request->get('page_count');
        if ($pageCountParam && is_numeric($pageCountParam)) {
            foreach ($pageMaxis as $pageMax) {
                if ($pageCountParam == $pageMax->getName()) {
                    $pageCount = $pageMax->getName();
                    $session->set('eccube.admin.customer_event.search.page_count', $pageCount);
                    break;
                }
            }
        }

        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);
            if ($searchForm->isValid()) {
                $searchData = $searchForm->getData();
                $page_no = 1;
                $session->set('eccube.admin.customer_event.search', FormUtil::getViewData($searchForm));
                $session->set('eccube.admin.customer_event.search.page_no', $page_no);
            } else {
                log_info($searchForm->getErrors(true));
                return [
                    'searchForm' => $searchForm->createView(),
                    'pagination' => [],
                    'pageMaxis' => $pageMaxis,
                    'page_no' => $page_no,
                    'page_count' => $pageCount,
                    'has_errors' => true,
                ];
            }
        } else {
            if (null !== $page_no || $request->get('resume')) {
                if ($page_no) {
                    $session->set('eccube.admin.customer_event.search.page_no', (int) $page_no);
                } else {
                    $page_no = $session->get('eccube.admin.customer_event.search.page_no', 1);
                }
                $viewData = $session->get('eccube.admin.customer_event.search', []);
            } else {
                $page_no = 1;
                $viewData = FormUtil::getViewData($searchForm);
                $session->set('eccube.admin.customer_event.search', $viewData);
                $session->set('eccube.admin.customer_event.search.page_no', $page_no);
            }
            $searchData = FormUtil::submitAndGetData($searchForm, $viewData);
        }

        $qb = $this->customerEventRepository->getQueryBuilderBySearchData($searchData);

        $pagination = $paginator->paginate(
            $qb,
            $page_no,
            $pageCount
        );

        return [
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'pageMaxis' => $pageMaxis,
            'page_no' => $page_no,
            'page_count' => $pageCount,
            'has_errors' => false,
        ];
    }

    /**
     * 削除
     * @Route("/%eccube_admin_route%/customer/event/{id}/delete", requirements={"id" = "\d+"}, name="admin_customer_event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $this->isTokenValid();

        log_info('顧客イベント削除開始', [$id]);

        $page_no = intval($this->session->get('eccube.admin.customer_event.search.page_no'));
        $page_no = $page_no ? $page_no : Constant::ENABLED;

        $CustomerEvent = $this->customerEventRepository->find($id);

        if (!$CustomerEvent) {
            $this->deleteMessage();

            return $this->redirect($this->generateUrl(
                'admin_customer_event_page',
                ['page_no' => $page_no]
            ) . '?resume=' . Constant::ENABLED);
        }

        try {
            $this->entityManager->remove($CustomerEvent);
            $this->entityManager->flush();
            $this->addSuccess('admin.common.delete_complete', 'admin');
        } catch (ForeignKeyConstraintViolationException $e) {
            log_error('顧客イベント削除失敗', [$e]);

            $message = trans('admin.common.delete_error_foreign_key', ['%id%' => $CustomerEvent->id]);
            $this->addError($message, 'admin');
        }

        log_info('顧客イベント削除完了', [$id]);

        return $this->redirect($this->generateUrl(
            'admin_customer_event_page',
            ['page_no' => $page_no]
        ) . '?resume=' . Constant::ENABLED);
    }

    /**
     * 顧客イベント登録
     * @Route("/%eccube_admin_route%/customer/event/new", name="admin_customer_event_new", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/event/edit.twig")
     */
    public function eventRegist(Request $request)
    {
        $customerEvent = new CustomerEvent();

        // フォーム作成
        $builder = $this->formFactory->createBuilder(CustomerEventType::class, $customerEvent);
        $form = $builder->getForm();
        $form->handleRequest($request);
        // 処理ボタン押下
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // フォーム内容で更新
                $customerEvent = $form->getData();
                $this->entityManager->persist($customerEvent);
                $this->entityManager->flush($customerEvent);

                // 成功ログと成功アラート設定
                log_info('customerEvent edit success');
                $this->addSuccess('admin.customer_event.save.complete', 'admin');

                // 更新画面にリダイレクト
                return $this->redirectToRoute(
                    'admin_customer_event_edit',
                    ['id' => $customerEvent->getId()]
                );
            } else {
                // 失敗ログと失敗アラート設定
                log_info($form->getErrors(true));
                $this->addError('admin.customer_event.save.failed', 'admin');
            }
        }
        return [
            'form' => $form->createView(),
            'CustomerEvent' => $customerEvent
        ];
    }

    /**
     * 顧客イベント更新
     * @Route("/%eccube_admin_route%/customer/event/{id}/edit", requirements={"id" = "\d+"}, name="admin_customer_event_edit", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/event/edit.twig")
     * @param Request リクエスト
     * @param id 該当データのID
     */
    public function eventEdit(Request $request, $id = null)
    {
        if (null === $id) {
            throw new NotFoundHttpException("id is null");
        }

        $customerEvent = $this->customerEventRepository->find($id);
        if (null === $customerEvent) {
            throw new NotFoundHttpException("customerEvent is null");
        }

        // フォーム作成
        $builder = $this->formFactory->createBuilder(CustomerEventType::class, $customerEvent);
        $form = $builder->getForm();
        $form->handleRequest($request);
        // 処理ボタン押下
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // フォーム内容で更新
                $customerEvent = $form->getData();
                // 現在日時を設定
                $this->entityManager->persist($customerEvent);
                $this->entityManager->flush($customerEvent);

                // 成功ログと成功アラート設定
                log_info('customerEvent edit success');
                $this->addSuccess('admin.sample.save.complete', 'admin');

                // 更新画面にリダイレクト
                return $this->redirectToRoute(
                    'admin_customer_event_edit',
                    ['id' => $customerEvent->getId()]
                );
            } else {
                // 失敗ログと失敗アラート設定
                log_info($editform->getErrors(true));
                $this->addError('admin.customer_event.save.failed', 'admin');
            }
        }
        return [
            'form' => $form->createView(),
            'CustomerEvent' => $customerEvent
        ];
    }

    /**
     * 顧客案件一覧
     * @Route("/%eccube_admin_route%/customer/project", name="admin_customer_project", methods={"GET"})
     * @Route("/%eccube_admin_route%/customer/project/page/{page_no}", requirements={"page_no" = "\d+"}, name="admin_customer_project_page", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/index.twig")
     */
    public function projectIndex(Request $request, PaginatorInterface $paginator, $page_no = null)
    {
        return [];
    }

    /**
     * 顧客案件登録
     * @Route("/%eccube_admin_route%/customer/project/new", name="admin_customer_project_new", methods={"GET", "POST"})
     * @Route("/%eccube_admin_route%/customer/project/{id}/edit", requirements={"id" = "\d+"}, name="admin_customer_project_edit", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/edit.twig")
     */
    public function projectEdit(Request $request)
    {
        return [];
    }

    //TODO
    /**
     * @Route("/%eccube_admin_route%/customer/project/new", name="admin_supplier", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/edit.twig")
     */
    public function admin_supplier(Request $request)
    {
        return [];
    }
    /**
     * @Route("/%eccube_admin_route%/customer/project/new", name="admin_supplier_project", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/edit.twig")
     */
    public function admin_supplier_project(Request $request)
    {
        return [];
    }
    /**
     * @Route("/%eccube_admin_route%/customer/project/new", name="admin_supplier_event", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/edit.twig")
     */
    public function admin_supplier_event(Request $request)
    {
        return [];
    }
    /**
     * @Route("/%eccube_admin_route%/customer/project/new", name="admin_receipt", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/edit.twig")
     */
    public function admin_receipt(Request $request)
    {
        return [];
    }
    /**
     * @Route("/%eccube_admin_route%/customer/project/new", name="admin_disbursement", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/edit.twig")
     */
    public function admin_disbursement(Request $request)
    {
        return [];
    }
    /**
     * @Route("/%eccube_admin_route%/customer/project/new", name="admin_attendance", methods={"GET", "POST"})
     * @Template("@Management42/admin/Customer/project/edit.twig")
     */
    public function admin_attendance(Request $request)
    {
        return [];
    }
}