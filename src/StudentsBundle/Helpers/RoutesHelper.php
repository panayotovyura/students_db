<?php

namespace StudentsBundle\Helpers;

use Doctrine\ORM\EntityManager;
use StudentsBundle\Helpers\PathGenerator;
use StudentsBundle\Entity\Student;

class RoutesHelper
{
    const BATCH_SIZE = 5000;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var PathGenerator
     */
    private $pathGenerator;

    public function __construct(EntityManager $entityManager, PathGenerator $pathGenerator)
    {
        $this->entityManager = $entityManager;
        $this->pathGenerator = $pathGenerator;
    }

    /*
     * Generate routes for students
     */
    public function generateRoutes()
    {
        $this->entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $query = $this->entityManager
            ->getRepository(Student::class)
            ->getAllStudentsQuery();

        $queryIterator = $query->iterate();
        $iteration = 0;
        foreach ($queryIterator as $row) {
            $student = $row[0];
            $student->setPath($this->pathGenerator->generatePath($student->getName()));
            if (($iteration % self::BATCH_SIZE) === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
            ++$iteration;
        }
        $this->entityManager->flush();
    }
}
