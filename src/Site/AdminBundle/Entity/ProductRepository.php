<?php

namespace Site\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    public function findAllAndOrderByType()
    {
        return $this->createQueryBuilder('p')->orderBy('p.type','ASC')->getQuery()->getResult();
    }
}
