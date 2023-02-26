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

namespace Plugin\Management42\Entity\Supplier;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

if (!class_exists('\Plugin\Management42\Entity\Supplier\SupplierEvent')) {
    /**
     * 取引先イベント
     *
     * @ORM\Table(name="plg_supplier_event")
     * @ORM\Entity(repositoryClass="Plugin\Management42\Repository\Supplier\SupplierEventRepository")
     */
    class SupplierEvent extends AbstractEntity
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
         * エンティティを紐づけると依存度が高くなるからあえてこの書き方(TODO)
         * @var string|null 取引先コード
         *
         * @ORM\Column(name="supplier_code", type="string", length=100)
         */
        private $supplier_code;

        /**
         * @var \DateTime イベント開始日時
         *
         * @ORM\Column(name="event_start_date", type="datetimetz")
         */
        private $event_start_date;


        /**
         * @var \DateTime イベント終了日時
         *
         * @ORM\Column(name="event_end_date", type="datetimetz")
         */
        private $event_end_date;

        /**
         * @var string 概要
         *
         * @ORM\Column(name="event_summary", type="string", length=255)
         * @Assert\NotBlank
         */
        private $event_summary;
    }
}