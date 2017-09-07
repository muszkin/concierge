<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ConciergeTagListRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class ConciergeTagListRepository extends EntityRepository
{

    public function getAllTags()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $query = $qb
            ->select("t")
            ->from("DashboardBundle:ConciergeTagList",'t')
            ->where('t.tag = t.icTag')
            ->getQuery();

        return $query->getResult();
    }
}