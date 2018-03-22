<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Comment;

class CommentService
{
    /**
     * @var CommentRepository
     */
    private $repository;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository('AppBundle:Comment');
        $this->entityManager = $entityManager;
    }


    public function persist(Comment $comment)
    {
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    public function remove(Comment $comment)
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }

}

