<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\RoleRepository;
use App\Repository\CommentRepository;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/profil/user/{id}", name="profil_user")
     */
    public function profile(QuestionRepository $questionRepo, CommentRepository $commentRepo, User $user)
    {
        return $this->render('user/profile.html.twig', [
            'questions' => $questionRepo->findByUser($user),
            'comments' => $commentRepo->findByUser($user)
        ]);
 
    }

    /**
     * @Route("/profil/user/edit/{id}", name="edit_user")
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserType::class, $user);
 
        $oldPassword = $user->getPassword();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(is_null($user->getPassword())){
                $encodedPassword = $oldPassword;
            } else { 
                $encodedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            }
            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice_edit_profil',
                'Données mises à jour!'
            );

            return $this->redirectToRoute('profil_user', ['id' => $user->getId()]);
        }

        
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/create", name="add_user")
     */
    public function new(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder, RoleRepository $roleRepository)
    {
        $user = new User();

        $roleUser= $roleRepository->findOneByCode('ROLE_KRYPTON_USER');
        
        $user->setRole($roleUser);
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encodedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'notice',
                'Bienvenue parmis nous ! Vous pouvez dès à présent vous connecter pour poser une question ou bien répondre à une question !'
            );

            return $this->redirectToRoute('homepage');
        }
        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
        
    }
}