<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\ParameterBag;

class HWishlistRepository extends EntityRepository
{
    public function getAllProductsForWishlist(ParameterBag $filters)
    {
        $page  = intval($filters->get('page'));
        $limit = intval($filters->get('limit'));
        $start = intval($filters->get('start'));

        $qb = $this->createQueryBuilder('w');
        $qb->where('w.status = :status');

        $search = $filters->get('s');
        if (!empty($search)) {
            $qb->andWhere($qb->expr()->like('p.name', $qb->expr()->literal("%" . $search . "%")));
        }

        if (empty($page) && empty($limit) && empty($start)) {
            $page  = 1;
            $limit = 50;
            $start = 0;
        }

        $qb->setParameter('status', 'active');
        $qb->setFirstResult(($page - 1) * $limit);
        $qb->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }
} 