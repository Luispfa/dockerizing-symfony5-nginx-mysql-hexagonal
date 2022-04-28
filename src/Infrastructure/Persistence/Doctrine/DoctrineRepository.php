<?php

declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function searchAll($entity): array
    {
        return $this->repository($entity)->findAll();
    }

    public function search($entity, int $id)
    {
        return $this->repository($entity)->find($id);
    }

    protected function persist($entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush($entity);
    }

    protected function remove($entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush($entity);
    }

    protected function repository($entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}
