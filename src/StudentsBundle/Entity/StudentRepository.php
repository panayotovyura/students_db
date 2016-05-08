<?php

namespace StudentsBundle\Entity;

use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    public function getAllStudentsQuery()
    {
        return $this->_em->createQuery('select u from StudentsBundle\Entity\Student u');
    }
}