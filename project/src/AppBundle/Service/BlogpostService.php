<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Blogpost;

class BlogpostService
{
    /**
     * @var BlogpostRepository
     */
    private $repository;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository('AppBundle:Blogpost');
        $this->entityManager = $entityManager;
    }
    public function fetchAllPosts()
    {
        return $this->repository->findAll();
    }

    public function persist(Blogpost $blogpost)
    {
        $this->entityManager->persist($blogpost);
        $this->entityManager->flush();
    }

    public function remove(Blogpost $blogpost)
    {
        $this->entityManager->remove($blogpost);
        $this->entityManager->flush();
    }

    public function fetchRecentPosts()
    {
         return $this->repository->findBy([], [], 5, 0);
        
    }


}

