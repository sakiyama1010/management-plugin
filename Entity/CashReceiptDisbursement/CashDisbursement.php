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

namespace Plugin\management\Entity\CashDisbursementDisbursement;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

if (!class_exists('\Plugin\management\Entity\CashReceiptDisbursement\CashDisbursement')) {
    /**
     * CashDisbursement
     *
     * @ORM\Table(name="plg_cash_disbursement")
     * @ORM\Entity(repositoryClass="Plugin\management\Repository\CashReceiptDisbursement\CashDisbursementRepository")
     */
    class CashDisbursement extends AbstractEntity
    {
        /**
         * @var int id
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var \DateTime 登録日時
         *
         * @ORM\Column(name="create_date", type="datetimetz")
         */
        private $create_date;

        /**
         * @var \DateTime 更新日時
         *
         * @ORM\Column(name="update_date", type="datetimetz")
         */
        private $update_date;

        /**
         * @var string 備考
         *
         * @ORM\Column(name="note", type="string", length=255)
         */
        private $note;
    }
}