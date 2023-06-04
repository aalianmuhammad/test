<?php

namespace App\Repository;

use App\Entity\Rijles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rijles>
 *
 * @method Rijles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rijles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rijles[]    findAll()
 * @method Rijles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RijlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rijles::class);
    }

    public function save(Rijles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Rijles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Rijles[] Returns an array of Rijles objects
     */
    public function findUser(): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles like :role')
            ->setParameter('role', '%KLANT%')
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findOneBySomeField($value): ?Rijles
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
