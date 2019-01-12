<?php
/**
 * Created by PhpStorm.
 * User: harut
 */

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * PlaceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlaceRepository extends EntityRepository
{

    /**
     * @param $fields
     * @return Paginator
     */
    public function getPlacesByFilter($fields)
    {
        /**
         * @var EntityManager $em
         */
        $em = $this->getEntityManager();
        $parameters = [];

        $query = $this->createQueryBuilder('p')->select('p')
            ->leftJoin('p.zipCode', 'zc');

        $count = 1000;
        $offset = 0;

        foreach ($fields as $key => $value) {
            if($value){
                if($key === 'count' || $key === 'offset'){
                    if($key === 'count'){
                        $count = $value;
                    } else if ($key === 'offset'){
                        $offset = $value;
                    }
                } else if($key === 'country'){
                    $parameters[$key] = $value;
                    $query->andWhere('zc.' . $key  . ' = ' .  ':' . $key);
                } else if($key === 'zip_code'){
                    $parameters[$key] =  '%' . $value . '%';
                    $query->andWhere('zc.zipCode' . ' LIKE ' .  ':' . $key);
                } else {
                    $parameters[$key] = $value;
                    $query->andWhere('p.' . $key  . ' = ' .  ':' . $key);
                }
            }
        }

        $query->orderBy('p.id', 'ASC');

        $query = $em
            ->createQuery($query->getDQL())
            ->setParameters($parameters)
            ->setFirstResult($offset)
            ->setMaxResults($count);

        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $paginator;
    }
}