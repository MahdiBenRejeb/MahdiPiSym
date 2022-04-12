<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\PublicationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{

    /**
     * @Route("/frontPublication", name="frontPublication")
     */
    public function indexAdmin(): Response
    {
        return $this->render('publication/frontPublication.html.twig', [
            'controller_name' => 'PublicationController',
        ]);
    }
    /**
     * @Route("/", name="display_publication")
     */
    public function index(): Response
    {
        $publications= $this->getDoctrine()->getManager()->getRepository(Publication::class)->findAll();
        return $this->render('publication/index.html.twig', [
             'b'=>$publications
        ]);
    }

    /**
     * @Route("/addPublication", name="addPublication")
     */
    public function addPublication(Request $request): Response
    {
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('display_publication');
        }
        return $this->render('publication/createPublication.html.twig',['f'=>$form->createView()]);
    }



    /**
     * @Route("/removePublication/{id}", name="supp_publication")
     */
    public function suppressionPublication(Publication $publication): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($publication);
        $em->flush();

        return $this->redirectToRoute('display_publication');
    }

    /**
     * @Route("/modifPublication/{id}", name="modifPublication")
     */
    public function modifPublication(Request $request,$id): Response
    {
        $publication = $this->getDoctrine()->getManager()->getRepository(Publication::class)->find($id);
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_publication');
        }
        return $this->render('publication/updatePublication.html.twig',['f'=>$form->createView()]);
    }


}
