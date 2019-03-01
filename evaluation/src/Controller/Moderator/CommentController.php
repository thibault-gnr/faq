<?php

namespace App\Controller\Moderator;


use App\Entity\Comment;
use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/moderator/controller")
*/
class CommentController extends AbstractController
{
    /**
     * @Route("/desactive/{id}", name="desactive_comment")
     */
    public function inactive(Comment $comment, EntityManagerInterface $em)
    {   
        $comment->setIsActive(false);

        $em->flush();
        $this->addFlash(
            'desactive',
            'Le commentaire vient d\'être désactivé'
        );

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/active/{id}", name="active_comment")
     */
    public function active(Comment $comment, EntityManagerInterface $em)
    {   
        $comment->setIsActive(true);

        $em->flush();
        $this->addFlash(
            'desactive',
            'Le commentaire vient d\'être désactivé'
        );

        return $this->redirectToRoute('homepage');
    }
}
