<?php

namespace App\DataFixtures;

use App\Utils\Slugger;
use App\Entity\User;
use App\Entity\Role;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $slugger;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, Slugger $slugger){ //ajouter l'encoder
        $this->slugger = $slugger;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $em)
    {

        $generator = Factory::create('fr_FR');

        //pour les admin
        $roleAdmin = new Role();
        $roleAdmin->setCode('ROLE_KRYPTON_ADMIN'); 
        $roleAdmin->setName('Administrateur'); 
        $em->persist($roleAdmin);

        //pour les moderateur
        $roleModerator = new Role();
        $roleModerator->setCode('ROLE_KRYPTON_MODERATOR');
        $roleModerator->setName('Moderateur');
        $em->persist($roleModerator);

        //pour les users
        $roleUser = new Role();
        $roleUser->setCode('ROLE_KRYPTON_USER');
        $roleUser->setName('Utilisateur');
        $em->persist($roleUser);

        $em->flush();

        $user = new User();
         $user->setEmail('admin@admin.fr');
         $user->setUsername('admin');
         $user->setRole($roleAdmin);
         $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin'));
         $user->setIsActive('1');


         $em->persist($user);

         $user = new User();
         $user->setEmail('moderator@moderator.fr');
         $user->setUsername('moderator');
         $user->setRole($roleModerator);
         $user->setPassword($this->passwordEncoder->encodePassword($user, 'moderator'));
         $user->setIsActive('1');


         $em->persist($user);

         $user = new User();
         $user->setEmail('user@user.fr');
         $user->setUsername('user');
         $user->setRole($roleUser);
         $user->setPassword($this->passwordEncoder->encodePassword($user, 'user'));
         $user->setIsActive('1');


         $em->persist($user);

         $em->flush();

        $populator = new Populator($generator, $em);

        $populator->addEntity('App\Entity\Question', 5, array(
            'body' => function() use ($generator) { //sur la propriété name de mon objet
                return $generator->text($maxNbChars = 400); //je retourne un name aleatoire a partir du generator
            },
            'createdAt' => function() use ($generator) { 
                return $generator->dateTime(); 
            },
            'isActive' => function() use ($generator) { 
                return $generator->boolean(); 
            },
            'title' => function() use ($generator) { //sur la propriété name de mon objet
                return $generator->text($maxNbChars = 30); //je retourne un name aleatoire a partir du generator
            }
        ), 
        [
            function($question){
                $convertedTitle = $this->slugger->sluggify($question->getTitle());
                $question->setSlug($convertedTitle); 
            },
        ]);		         

        $populator->addEntity('App\Entity\Comment', 5, array(
            'body' => function() use ($generator) { //sur la propriété name de mon objet
                return $generator->text($maxNbChars = 120); //je retourne un name aleatoire a partir du generator
            },
            'createdAt' => function() use ($generator) { 
                return $generator->dateTime(); 
            },
            'isActive' => function() use ($generator) { 
                return $generator->boolean(); 
            },
        ));

        $populator->addEntity('App\Entity\Tag', 20, array(
            'tagName' => function() use ($generator) { 
                return $generator->word (); 
            },

        ));

        $insertedElements = $populator->execute();


    }
}