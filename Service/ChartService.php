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

namespace Plugin\Management42\Service;

use Carbon\Carbon;

class ChartService
{

    /**
     * 期間毎にデータをまとめる
     *
     * @param $result
     * @param Carbon $fromDate
     * @param Carbon $toDate
     * @param $format
     *
     * @return array
     */
    protected function summarizeDataByPeriod($result, Carbon $fromDate, Carbon $toDate, $format)
    {
        $raw = [];
        for ($date = $fromDate; $date <= $toDate; $date = $date->addDay()) {
            $raw[$date->format($format)]['price'] = 0;
            $raw[$date->format($format)]['count'] = 0;
        }

        foreach ($result as $Order) {
            $raw[$Order->getOrderDate()->format($format)]['price'] += $Order->getPaymentTotal();
            ++$raw[$Order->getOrderDate()->format($format)]['count'];
        }

        return $raw;
    }

}