<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\User;
use App\Utils\Slugger;
use App\Entity\Comment;
use App\Entity\Question;
use App\Form\CommentType;
use App\Form\QuestionType;
use App\Repository\TagRepository;
use App\Repository\CommentRepository;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(QuestionRepository $questionRepo, TagRepository $tagRepo)
    {
        $questions = $questionRepo->questionsByDate();
        $tags = $tagRepo->findAll();

        return $this->render('question/index.html.twig', [
            'questions' => $questions,
            'tags' => $tags,
        ]);
    }
    /**
     * @Route("/question/addEdit/{user}", name="question_edit")
     */
    public function addEdit(Request $request, EntityManagerInterface $em, Slugger $slugger){
        
        $user = $this->getUser($request->get('user'));

        $question = new Question();
        
        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $question->setUser($user);

            $convertedTitle = $slugger->sluggify($question->getTitle());                   
            $question->setSlug($convertedTitle);

            $em->persist($question);//ignoré si update
            $em->flush();

            $this->addFlash(
                'ajoutQuestion',
                'Votre question vient d\'être ajoutée !'
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render('question/addEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tag/{id}", name="questions_by_tag")
     */
    public function questionsByTag(Tag $tag, TagRepository $tagRepo)
    {
        return $this->render('question/listByTag.html.twig', [
            'tag' => $tag
        ]);
    }

    /**
     * @Route("/question/{slug}", name="question_show")
     */
    public function show(Question $question, Request $request, CommentRepository $commentRepo, EntityManagerInterface $em)
    {
        // on récupére le nom de l'utilisateur en cours pour setter le nom dans le commentaire
        if ($this->getUser() != null ){
            $userCurrent=$this->getUser();
            $userName= $userCurrent->getUsername();
            $user = $this->getUser($userName);
        }

        //Trouve les commentaires associés à la question
        $comments = $commentRepo->findCommentsByQuestion($question);

        //Génére le formulaire
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $comment->setUser($user);

            $comment->setQuestion($question);
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);//ignoré si update
            $em->flush();

            $this->addFlash(
                'ajoutCommentaire',
                'Votre commentaire vient d\'être ajouté !'
            );

            return $this->redirectToRoute('question_show', [
                'slug' => $question->getSlug()
            ]);
        }

        return $this->render('question/show.html.twig', [
            'question' => $question,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }



}
