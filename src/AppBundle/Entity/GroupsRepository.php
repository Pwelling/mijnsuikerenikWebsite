<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GroupsRepository extends EntityRepository
{
    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return Groups[]
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('g')
            ->from('AppBundle:Groups', 'g');
        foreach ($criteria as $field => $value) {
            $qb
                ->andWhere('g.' . $field . '= :' . $field)
                ->setParameter($field, $value);
        }
        if (!is_null($orderBy)) {
            foreach ($orderBy as $field => $order) {
                $qb->addOrderBy('g.' . $field, $order);
            }
        }
        $qb->setMaxResults(1);
        return $qb->getQuery()->getResult();
    }
}
