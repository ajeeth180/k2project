<?php

namespace AppBundle\Repository;

/**
 * LessonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LessonRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBeschikbareLessen($userid)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT l FROM AppBundle:Lesson l WHERE :userid NOT MEMBER OF l.user ORDER BY l.datum");

        $query->setParameter('userid',$userid);

        return $query->getResult();
    }
}
