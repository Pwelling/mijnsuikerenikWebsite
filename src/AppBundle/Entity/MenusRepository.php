<?php

namespace AppBundle\Entity;

class MenusRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $parentId
     * @return Menus[]
     */
    public function findByParentId($parentId)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('AppBundle:Menus', 'm')
            ->andWhere('m.parentid = :parentId')
            ->setParameter(':parentId', $parentId);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return Menus[]
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('AppBundle:Menus', 'm');
        foreach($criteria as $field => $value) {
            $qb
                ->andWhere('m.' . $field .'= :' . $field)
                ->setParameter(':' . $field, $value);
        }
        return $qb->getQuery()->getResult();
    }
}
