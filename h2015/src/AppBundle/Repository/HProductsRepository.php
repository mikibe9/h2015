<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\ParameterBag;

class HProductsRepository extends EntityRepository
{

    public function getAllProductsByFilters(ParameterBag $filters)
    {
        $page  = intval($filters->get('page'));
        $limit = intval($filters->get('limit'));
        $start = intval($filters->get('start'));

        $qb = $this->createQueryBuilder('p');

        $search = $filters->get('s');
        if (!empty($search)) {
            $qb->where($qb->expr()->like('p.name', $qb->expr()->literal("%" . $search . "%")));
        }

        if (empty($page) && empty($limit) && empty($start)) {
            $page  = 1;
            $limit = 50;
            $start = 0;
        }

        $qb->setFirstResult(($page - 1) * $limit);
        $qb->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }

} 