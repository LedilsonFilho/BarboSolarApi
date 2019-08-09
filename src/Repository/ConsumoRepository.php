<?php

namespace App\Repository;

use App\Entity\Consumo;
use App\Helper\ResponseFactory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Consumo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consumo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consumo[]    findAll()
 * @method Consumo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsumoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Consumo::class);
    }

    // /**
    //  * @return Consumo[] Returns an array of Consumo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consumo
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findOneByYear($id_isntalacao, $ano, $credito)
    {
        $emConfig = $this->getEntityManager()->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        //$emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
        //$emConfig->addCustomDatetimeFunction('DAY', 'DoctrineExtensions\Query\Mysql\Day');

        $qb = $this->createQueryBuilder('c');
        $qb->select('c')
            ->where('YEAR(c.datareferencia) = :year')
            ->andWhere('c.instalacoes_id = :instalacoes_id')
            ->andWhere('c.credito = :credito');
            //->andWhere('MONTH(p.dataReferencia) = :month')
            //->andWhere('DAY(p.dataReferencia) = :day');

        $qb->setParameter('year', $ano)
            ->setParameter('instalacoes_id', $id_isntalacao)
            ->setParameter('credito', $credito)
            ->orderBy('c.datareferencia', 'ASC');
            //->setParameter('month', $month)
            //->setParameter('day', $day);


        $post = $qb->getQuery()->getResult();
        return $post;
    }
}
