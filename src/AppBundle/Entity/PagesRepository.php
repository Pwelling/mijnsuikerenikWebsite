<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PagesRepository extends EntityRepository
{
    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return Pages[]
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Pages', 'p');
        foreach ($criteria as $field => $value) {
            $qb
                ->andWhere('p.' . $field . '= :' . $field)
                ->setParameter($field, $value);
        }
        if (!is_null($orderBy)) {
            foreach ($orderBy as $field => $order) {
                $qb->addOrderBy('p.' . $field, $order);
            }
        }
        $qb->setMaxResults(1);
        return $qb->getQuery()->getResult();
    }
}
