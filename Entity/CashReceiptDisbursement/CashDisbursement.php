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

namespace Plugin\Management42\Entity\CashDisbursementDisbursement;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Eccube\Entity\Member;
use Plugin\Management42\Entity\Master\DisbursementType;
use Symfony\Component\Validator\Constraints as Assert;

if (!class_exists(CashDisbursement::class, false)) {
    /**
     * CashDisbursement
     *
     * @ORM\Table(name="plg_cash_disbursement")
     * @ORM\Entity(repositoryClass="Plugin\Management42\Repository\CashReceiptDisbursement\CashDisbursementRepository")
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
         * @var string 支出内容
         *
         * @ORM\Column(name="summary", type="string", length=100)
         * @Assert\NotBlank
         */
        private $summary;

        /**
         * @var string 支出先
         *
         * @ORM\Column(name="payee", type="string", length=100)
         * @Assert\NotBlank
         */
        private $payee;

        /**
         * 
         * @var string 支払金額(円)
         *
         * @ORM\Column(name="pay_amount_yen", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         * @Assert\NotBlank
         */
        private $pay_amount_yen;

        /**
         * 
         * @var string 支払金額(ドル)
         *
         * @ORM\Column(name="pay_amount_dollar", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         * @Assert\NotBlank
         */
        private $pay_amount_dollar;

        /**
         * @var \Eccube\Entity\Member 申請者
         *
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\Member")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="member_id", referencedColumnName="id")
         * })
         */
        private $Member;

        /**
         * @var \Plugin\Management42\Entity\Master\DisbursementType 支出区分
         *
         * @ORM\ManyToOne(targetEntity="Plugin\Management42\Entity\Master\DisbursementType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="disbursement_type_id", referencedColumnName="id")
         * })
         */
        private $DisbursementType;

        /**
         * @var \DateTime 支払日時
         *
         * @ORM\Column(name="payment_date", type="datetimetz")
         */
        private $payment_date;

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
         * @var string|null 備考
         *
         * @ORM\Column(name="note", type="string", length=4000, nullable=true)
         */
        private $note;

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getSummary(): ?string
        {
            return $this->summary;
        }

        public function setSummary(string $summary): self
        {
            $this->summary = $summary;

            return $this;
        }

        public function getPayee(): ?string
        {
            return $this->payee;
        }

        public function setPayee(string $payee): self
        {
            $this->payee = $payee;

            return $this;
        }

        public function getPayAmountYen(): ?string
        {
            return $this->pay_amount_yen;
        }

        public function setPayAmountYen(string $pay_amount_yen): self
        {
            $this->pay_amount_yen = $pay_amount_yen;

            return $this;
        }

        public function getPayAmountDollar(): ?string
        {
            return $this->pay_amount_dollar;
        }

        public function setPayAmountDollar(string $pay_amount_dollar): self
        {
            $this->pay_amount_dollar = $pay_amount_dollar;

            return $this;
        }

        public function getPaymentDate(): ?\DateTimeInterface
        {
            return $this->payment_date;
        }

        public function setPaymentDate(\DateTimeInterface $payment_date): self
        {
            $this->payment_date = $payment_date;

            return $this;
        }

        public function getCreateDate(): ?\DateTimeInterface
        {
            return $this->create_date;
        }

        public function setCreateDate(\DateTimeInterface $create_date): self
        {
            $this->create_date = $create_date;

            return $this;
        }

        public function getUpdateDate(): ?\DateTimeInterface
        {
            return $this->update_date;
        }

        public function setUpdateDate(\DateTimeInterface $update_date): self
        {
            $this->update_date = $update_date;

            return $this;
        }

        public function getNote(): ?string
        {
            return $this->note;
        }

        public function setNote(?string $note): self
        {
            $this->note = $note;

            return $this;
        }

        public function getMember(): ?Member
        {
            return $this->Member;
        }

        public function setMember(?Member $Member): self
        {
            $this->Member = $Member;

            return $this;
        }

        public function getDisbursementType(): ?DisbursementType
        {
            return $this->DisbursementType;
        }

        public function setDisbursementType(?DisbursementType $DisbursementType): self
        {
            $this->DisbursementType = $DisbursementType;

            return $this;
        }
    }
}