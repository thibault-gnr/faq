<?php

namespace App\Controller\Moderator;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/moderator/question")
*/
class QuestionController extends AbstractController
{
    /**
     * @Route("/desactive/{id}", name="desactive_questions")
     */
    public function inactive(Question $question,EntityManagerInterface $em)
    {   
        
        $question->setIsActive(false);

        $em->flush();
        $this->addFlash(
            'desactive',
            'La question vient d\'être désactivée'
        );

        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/active/{id}", name="active_questions")
     */
    public function active(Question $question,EntityManagerInterface $em)
    {   
        
        $question->setIsActive(true);

        $em->flush();
        $this->addFlash(
            'desactive',
            'La question vient d\'être réactivée'
        );

        return $this->redirectToRoute('homepage');
    }
}
