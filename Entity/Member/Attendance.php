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

namespace Plugin\management\Entity\Member;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

if (!class_exists('\Plugin\management\Entity\Member\Attendance')) {
    /**
     * attendance
     *
     * @ORM\Table(name="plg_member_attendance")
     * @ORM\Entity(repositoryClass="Plugin\management\Repository\Member\AttendanceRepository")
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
         * @ORM\Column(name="work_hour", type="int", length=10)
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
    }
}