<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Entity\User;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/users")
*/
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="admin_user_index")
    */
    public function index(UserRepository $userRepository)
    {   

        return $this->render('admin/user/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/changeToAdmin/{id}", name="change_to_admin")
     */
    public function inactive(User $user,UserRepository $userRepository, EntityManagerInterface $em,Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {  
        $form = $this->createForm(AdminUserType::class, $user);
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

            return $this->render('admin/user/index.html.twig', ['users' => $userRepository->findAll()]);
        }
        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="admin_user_delete")
    */
    public function delete(Request $request, User $user)
    {
       
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        return $this->redirectToRoute('admin_user_index');
    }
}

