<?php
/**
 * Created by PhpStorm.
 * User: adrian.bratulescu
 * Date: 6/13/2015
 * Time: 5:44 PM
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class HBasketRepository extends EntityRepository
{

    public function getAllProductsExcept(Array $products)
    {
        $qb = $this->createQueryBuilder('b');
        $qb->where($qb->expr()->notIn('b.hProducts', array_values($products)));

        return $qb->getQuery()->getResult();

    }

}