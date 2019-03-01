<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/validate/{id}", name="comment_validate")
     */
    public function validate(Comment $comment,EntityManagerInterface $em)
    {   
        $question = $this->getDoctrine()->getRepository(Question::class)->findOneById($comment->getQuestion());
        
        $comment->setValidateComment(true);
        $em->flush();
        $this->addFlash(
            'desactive',
            'Le commentaire vient d\'être épinglé'
        );
        return $this->redirectToRoute('question_show', [
            'slug' => $question->getSlug()
        ]);
    }
    /**
     * @Route("/comment/novalidate/{id}", name="comment_novalidate")
     */
    public function novalidate(Comment $comment, EntityManagerInterface $em)
    {
        $question = $this->getDoctrine()->getRepository(Question::class)->findOneById($comment->getQuestion());

        $comment->setValidateComment(false);

        $em->flush();
        $this->addFlash(
            'desactive',
            'Le commentaire n\'est plus épinglé'
        );
        return $this->redirectToRoute('question_show', [
        'slug' => $question->getSlug()
        ]);
    }
}
