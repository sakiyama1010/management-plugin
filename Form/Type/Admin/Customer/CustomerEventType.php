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

namespace Plugin\management\Form\Type\Admin\Customer;

use Eccube\Common\EccubeConfig;
use Plugin\management\Repository\Customer\CustomerEventRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
// これがないと`$builder->getForm();`で怒られる
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CustomerEventType extends AbstractType
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
            ->add('customerCode', TextType::class, [
                'label' => 'admin.customer_event.customer_code',
                'required' => true,
                'constraints' => [
                    new Assert\Length(['max' => $this->eccubeConfig['eccube_stext_len']]),
                ],
            ])
            ->add('eventSummary', TextType::class, [
                'label' => 'admin.customer_event.event_summary',
                'required' => true,
                'constraints' => [
                    new Assert\Length(['max' => $this->eccubeConfig['eccube_stext_len']]),
                ],
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
