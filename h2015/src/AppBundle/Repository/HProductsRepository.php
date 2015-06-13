<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
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

    public function getAllProductsOffers(ParameterBag $filters, EntityManager $entityManager)
    {
        $page  = intval($filters->get('page'));
        $limit = intval($filters->get('limit'));
        $start = intval($filters->get('start'));

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:HProducts', 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'price', 'price');
        $rsm->addFieldResult('p', 'discount', 'discount');
//        $rsm->addFieldResult('p', 'delivery_estimated_cost', 'delivery_estimated_cost');
//        $rsm->addFieldResult('p', 'h_brands_id', 'h_brands_id');
//        $rsm->addFieldResult('p', 'h_categories_id', 'h_categories_id');
        $rsm->addFieldResult('p', 'status', 'status');

        $queryS
                = 'SELECT p.* FROM h_products p LEFT JOIN h_basket b ON p.id=b.h_products_id LEFT JOIN h_wishlist w ON p.id=w.h_products_id
WHERE (b.id IS NOT NULL OR w.id IS NOT NULL)';
        $search = $filters->get('s');
        if (!empty($search)) {
            $queryS .= 'AND p.name LIKE"%' . $search . '%"';
        }


        if (empty($page) && empty($limit) && empty($start)) {
            $page  = 1;
            $limit = 50;
            $start = 0;
        }
        $queryS .= " LIMIT " . ($page - 1) * $limit . "," . $limit;

        $query = $entityManager->createNativeQuery($queryS, $rsm);

        return $query->getResult();
    }

} 