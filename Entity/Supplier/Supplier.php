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

if (!class_exists('\Plugin\Management42\Entity\Supplier\Supplier')) {
    /**
     * 取引先
     *
     * @ORM\Table(name="plg_Supplier")
     * @ORM\Entity(repositoryClass="Plugin\Management42\Repository\Supplier\SupplierRepository")
     */
    class Supplier extends AbstractEntity
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
         * @var string 取引先コード
         *
         * @ORM\Column(name="supplier_code", type="string", length=4)
         * @Assert\NotBlank
         */
        private $supplier_code;

        /**
         * @var string 取引先名
         *
         * @ORM\Column(name="supplier_name", type="string", length=50)
         * @Assert\NotBlank
         */
        private $supplier_name;

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

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getSupplierCode(): ?string
        {
            return $this->supplier_code;
        }

        public function setSupplierCode(string $supplier_code): self
        {
            $this->supplier_code = $supplier_code;

            return $this;
        }

        public function getSupplierName(): ?string
        {
            return $this->supplier_name;
        }

        public function setSupplierName(string $supplier_name): self
        {
            $this->supplier_name = $supplier_name;

            return $this;
        }

        public function setCreateDate(\DateTimeInterface $create_date): self
        {
            $this->create_date = $create_date;

            return $this;
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

        public function setNote(string $note): self
        {
            $this->note = $note;

            return $this;
        }

        public function getCreateDate(): ?\DateTimeInterface
        {
            return $this->create_date;
        }

        public function getUpdateDate(): ?\DateTimeInterface
        {
            return $this->update_date;
        }
    }
}