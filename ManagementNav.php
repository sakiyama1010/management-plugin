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

namespace Plugin\Management42;

use Eccube\Common\EccubeNav;

class ManagementNav implements EccubeNav
{
    /**
     * @return array
     */
    public static function getNav()
    {
        return [
            'supplier' => [
                'name' => '取引先管理',
                'icon' => 'fa-building',
                'children' => [
                    // 取引先管理
                    'supplier' => [
                        'name' => 'admin.supplier.supplier_list',
                        'url' => 'admin_supplier',
                    ],
                    // 顧客管理(既存)
                    'member' => [
                        'name' => 'admin.supplier.customer_list',
                        'url' => 'admin_customer',
                    ],
                    // 取引先案件管理
                    'supplier_project' => [
                        'name' => 'admin.supplier.project_list',
                        'url' => 'admin_supplier_project',
                    ],
                    // 取引先イベント管理
                    'supplier_event' => [
                        'name' => 'admin.supplier.event_list',
                        'url' => 'admin_supplier_event',
                    ],
                ],
            ],
            'cash_receipt_disbursement' => [
                'name' => '入出金管理',
                'icon' => 'fa-money',
                'children' => [
                    // 入金管理
                    'receipt' => [
                        'name' => 'admin.cash_receipt_disbursement.receipt_list',
                        'url' => 'admin_receipt',
                    ],
                    // 出金管理
                    'disbursement' => [
                        'name' => 'admin.cash_receipt_disbursement.disbursement_list',
                        'url' => 'admin_disbursement',
                    ],
                ],
            ],
            'member' => [
                'name' => 'メンバー管理',
                'icon' => 'fa-user',
                'children' => [
                    // メンバー管理(既存)
                    'member' => [
                        'name' => 'admin.setting.system.member_management',
                        'url' => 'admin_setting_system_member',
                    ],
                    // 勤怠管理
                    'attendance' => [
                        'name' => 'admin.member.attendance_list',
                        'url' => 'admin_attendance',
                    ],
                ],
            ],
            
        ];
    }
}
