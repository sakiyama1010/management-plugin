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

namespace Plugin\Management42\Entity\Master;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\Master\AbstractMasterEntity;

if (!class_exists(DisbursementType::class, false)) {
    /**
     * DisbursementType
     *
     * @ORM\Table(name="mtb_disbursement_type")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Eccube\Repository\Master\DisbursementTypeRepository")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    class DisbursementType extends AbstractMasterEntity
    {
        /**
         * テスト区分
         */
        public const TEST = 1;
    }
}
