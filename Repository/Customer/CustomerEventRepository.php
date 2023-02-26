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

namespace Plugin\Management42\Repository\Customer;

use Eccube\Repository\AbstractRepository;
use Plugin\Management42\Entity\Customer\CustomerEvent;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;
use Eccube\Doctrine\Query\Queries;
use Plugin\Management42\Entity\CustomerTrait;

/**
 * 顧客イベントリポジトリ
 * @extends AbstractRepository
 */
class CustomerEventRepository extends AbstractRepository
{
    /**
     * @var Queries
     */
    protected $queries;

    public const COLUMNS = [
        'customer_event_id' => 'c.id'
    ];

    /**
     * @param RegistryInterface $registry
     * @param Queries $queries
     */
    public function __construct(RegistryInterface $registry, Queries $queries)
    {
        parent::__construct($registry, CustomerEvent::class);
        $this->queries = $queries;
    }

    /**
     * @param array $searchData
     * @return QueryBuilder
     */
    public function getQueryBuilderBySearchData($searchData)
    {
        $qb = $this->createQueryBuilder('ce')
            ->innerJoin('Eccube\Entity\Customer', 'c', 'WITH', 'c.customer_code = ce.customer_code')
            //TODO
            //->select('ce,c.company_name');
            ->select('ce');

        if (isset($searchData['customer_code']) && !empty($searchData['customer_code'])) {
            $qb
                ->andWhere("ce.customer_code = :customer_code")
                ->setParameter('customer_code', $searchData['customer_code']);
        }

        // Order By
        if (isset($searchData['sortkey']) && !empty($searchData['sortkey'])) {
            $sortOrder = (isset($searchData['sorttype']) && $searchData['sorttype'] == 'a') ? 'ASC' : 'DESC';
            $qb->orderBy(self::COLUMNS[$searchData['sortkey']], $sortOrder);
            //$qb->addOrderBy('ce.event_end_date', 'DESC');
            $qb->addOrderBy('ce.id', 'DESC');
        } else {
            //$qb->orderBy('ce.event_end_date', 'DESC');
            //$qb->addOrderBy('ce.id', 'DESC');
            $qb->orderBy('ce.id', 'DESC');
        }

        return $qb;
    }
}