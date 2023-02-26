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

namespace Plugin\Management42\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation as Eccube;

/**
 * @Eccube\EntityExtension("Eccube\Entity\Customer")
 */
trait CustomerTrait
{

    /**
     * @var string|null
     *
     * @ORM\Column(name="customer_code", type="string", length=100)
     */
    private $customer_code;

    /**
     * @return string
     */
    public function getCustomerCode()
    {
        return $this->customer_code;
    }

    /**
     * @param string $customer_code
     */
    public function setCustomerCode($customer_code)
    {
        $this->customer_code = $customer_code;
    }
}