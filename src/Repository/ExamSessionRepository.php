<?php

namespace App\Repository;

use App\Entity\ExamSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ExamSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamSession::class);
    }

    public function findAllFutureSessions(): array
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.sessionDate > :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('e.sessionDate', 'ASC');

        return $qb->getQuery()->execute();
    }
}
