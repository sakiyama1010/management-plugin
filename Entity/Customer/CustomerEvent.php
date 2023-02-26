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
use Eccube\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

if (!class_exists('\Plugin\Management42\Entity\Customer\CustomerEvent')) {
    /**
     * 顧客イベント
     *
     * @ORM\Table(name="plg_customer_event")
     * @ORM\Entity(repositoryClass="Plugin\Management42\Repository\Customer\CustomerEventRepository")
     */
    class CustomerEvent extends AbstractEntity
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
         * @var string|null 顧客コード
         *
         * @ORM\Column(name="customer_code", type="string", length=100)
         */
        private $customer_code;

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

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getCustomerCode(): ?string
        {
            return $this->customer_code;
        }

        public function setCustomerCode(string $customer_code): self
        {
            $this->customer_code = $customer_code;

            return $this;
        }

        public function getEventStartDate(): ?\DateTimeInterface
        {
            return $this->event_start_date;
        }

        public function setEventStartDate(\DateTimeInterface $event_start_date): self
        {
            $this->event_start_date = $event_start_date;

            return $this;
        }

        public function getEventEndDate(): ?\DateTimeInterface
        {
            return $this->event_end_date;
        }

        public function setEventEndDate(\DateTimeInterface $event_end_date): self
        {
            $this->event_end_date = $event_end_date;

            return $this;
        }

        public function getEventSummary(): ?string
        {
            return $this->event_summary;
        }

        public function setEventSummary(string $event_summary): self
        {
            $this->event_summary = $event_summary;

            return $this;
        }
    }
}