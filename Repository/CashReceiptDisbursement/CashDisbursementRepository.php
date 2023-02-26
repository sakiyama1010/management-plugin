<?php

namespace Plugin\Management42\Repository\CashReceiptDisbursement;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Plugin\Management42\Entity\CashDisbursementDisbursement\CashDisbursement;

/**
 * @extends ServiceEntityRepository<CashDisbursement>
 *
 * @method CashDisbursement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CashDisbursement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CashDisbursement[]    findAll()
 * @method CashDisbursement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CashDisbursementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashDisbursement::class);
    }

    public function add(CashDisbursement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CashDisbursement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CashDisbursement[] Returns an array of CashDisbursement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CashDisbursement
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
