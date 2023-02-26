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

namespace Plugin\Management42\Entity\Member;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

if (!class_exists('\Plugin\Management42\Entity\Member\Attendance')) {
    /**
     * attendance
     *
     * @ORM\Table(name="plg_member_attendance")
     * @ORM\Entity(repositoryClass="Plugin\Management42\Repository\Member\AttendanceRepository")
     */
    class Attendance extends AbstractEntity
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
         * @var string メンバーID
         *
         * @ORM\Column(name="member_id", type="string", length=4)
         * @Assert\NotBlank
         */
        private $supplier_code;

        /**
         * @var string 始業時間
         *
         * @ORM\Column(name="start_time", type="string", length=10)
         * @Assert\NotBlank
         */
        private $start_time;

        /**
         * @var string 終業時間
         *
         * @ORM\Column(name="end_time", type="string", length=10)
         * @Assert\NotBlank
         */
        private $end_time;

        /**
         * @var string 勤務時間
         *
         * @ORM\Column(name="work_hour", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         * @Assert\NotBlank
         */
        private $work_hour;

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

        public function getStartTime(): ?string
        {
            return $this->start_time;
        }

        public function setStartTime(string $start_time): self
        {
            $this->start_time = $start_time;

            return $this;
        }

        public function getEndTime(): ?string
        {
            return $this->end_time;
        }

        public function setEndTime(string $end_time): self
        {
            $this->end_time = $end_time;

            return $this;
        }

        public function getWorkHour()
        {
            return $this->work_hour;
        }

        public function setWorkHour($work_hour): self
        {
            $this->work_hour = $work_hour;

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

        public function setNote(string $note): self
        {
            $this->note = $note;

            return $this;
        }
    }
}