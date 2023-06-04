<?php

namespace App\Repository;

use App\Entity\ExamenAanvraag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExamenAanvraag>
 *
 * @method ExamenAanvraag|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenAanvraag|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenAanvraag[]    findAll()
 * @method ExamenAanvraag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenAanvraagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenAanvraag::class);
    }

    public function save(ExamenAanvraag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ExamenAanvraag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ExamenAanvraag[] Returns an array of ExamenAanvraag objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExamenAanvraag
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
