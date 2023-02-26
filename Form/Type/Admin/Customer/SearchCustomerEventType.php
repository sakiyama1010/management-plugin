<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Management42\Form\Type\Admin\Customer;

use Eccube\Common\EccubeConfig;
use Plugin\Management42\Repository\Customer\CustomerEventRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
// これがないと`$builder->getForm();`で怒られる
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class SearchCustomerEventType extends AbstractType
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var CustomerEventRepository
     */
    protected $CustomerEventRepository;

    /**
     * SearchCustomerEventType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     * @param CustomerEventRepository $CustomerEventRepository
     */
    public function __construct(
        CustomerEventRepository $CustomerEventRepository,
        EccubeConfig $eccubeConfig
    ) {
        $this->eccubeConfig = $eccubeConfig;
        $this->CustomerEventRepository = $CustomerEventRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('customer_code', TextType::class, [
                'label' => 'admin.customer_event.customer_code',
                'required' => false,
                'constraints' => [
                    new Assert\Length(['max' => $this->eccubeConfig['eccube_stext_len']]),
                ],
            ])
            // ソート用
            ->add('sortkey', HiddenType::class, [
                'label' => 'admin.list.sort.key',
                'required' => false,
            ])
            ->add('sorttype', HiddenType::class, [
                'label' => 'admin.list.sort.type',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'admin_customer_event';
    }
}
