<?php

namespace App\Controller\Moderator;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/moderator/tag")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", name="moderator_tag")
     */
    public function index(TagRepository $tagRepo)
    {
        return $this->render('Moderator/tag/index.html.twig', [
            'tags' => $tagRepo->findAll()
        ]);
        
    }

    /**
     * @Route("/new", name="moderator_tag_new")
    */
    public function new(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            $this->addFlash(
                'tagg_add',
                'Tag ajouté'
            );

            return $this->redirectToRoute('moderator_tag');
        }

        return $this->render('Moderator/tag/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="moderator_tag_edit")
    */
    public function edit(Request $request, Tag $tag)
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'tagg_add',
                'Tag modifié'
            );

            return $this->redirectToRoute('moderator_tag', ['id' => $tag->getId()]);
        }
        return $this->render('Moderator/tag/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="moderator_tag_delete")
    */
    public function delete(Request $request, Tag $tag, EntityManagerInterface $em)
    {   
        $em->remove($tag);
        $em->flush();

        $this->addFlash(
            'tagg_delete',
            'Le tag vient d\' être supprimé'
        );
        return $this->redirectToRoute('moderator_tag');
    }

}
