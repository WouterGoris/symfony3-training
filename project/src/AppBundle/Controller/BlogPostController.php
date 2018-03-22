<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blogpost;
use AppBundle\Service\BlogpostService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Blogpost controller.
 *
 * @Route("blogpost")
 */
class BlogPostController extends Controller
{

    private $blogpostService;
    
    public function __construct(BlogpostService $blogpostService)
    {
        $this->blogpostService = $blogpostService;
    }
    /**
     * Lists all blogpost entities.
     *
     * @Route("/", name="blogpost_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        $blogposts = $this->blogpostService->fetchAllPosts();

        return $this->render('blogpost/index.html.twig', array(
            'blogposts' => $blogposts,
        ));
    }

    /**
     * Creates a new blogpost entity.
     *
     * @Route("/new", name="blogpost_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $blogpost = new Blogpost();
        $form = $this->createForm('AppBundle\Form\BlogpostType', $blogpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->blogpostService->persist($blogpost);

            return $this->redirectToRoute('blogpost_show', array('id' => $blogpost->getId()));
        }

        return $this->render('blogpost/new.html.twig', array(
            'blogpost' => $blogpost,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a blogpost entity.
     *
     * @Route("/{id}", name="blogpost_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Blogpost $blogpost)
    {
        
        $deleteForm = $this->createDeleteForm($blogpost);

        return $this->render('blogpost/show.html.twig', array(
            'blogpost' => $blogpost,
            'delete_form' => $deleteForm->createView(),
        ));
    } 

    /**
     * Displays a form to edit an existing blogpost entity.
     *
     * @Route("/{id}/edit", name="blogpost_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Blogpost $blogpost)
    {
        $deleteForm = $this->createDeleteForm($blogpost);
        $editForm = $this->createForm('AppBundle\Form\BlogpostType', $blogpost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            //$this->getDoctrine()->getManager()->flush();
            $this->blogpostService->persist($blogpost);

            return $this->redirectToRoute('blogpost_index');
        }

        return $this->render('blogpost/edit.html.twig', array(
            'blogpost' => $blogpost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a blogpost entity.
     *
     * @Route("/{id}", name="blogpost_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Blogpost $blogpost)
    {
        $form = $this->createDeleteForm($blogpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->blogpostService()->remove($blogpost);
            //$em = $this->getDoctrine()->getManager();
            //$em->remove($blogpost);
            //$em->flush();
        }

        return $this->redirectToRoute('blogpost_index');
    }

    /**
     * Creates a form to delete a blogpost entity.
     *
     * @param Blogpost $blogpost The blogpost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Blogpost $blogpost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blogpost_delete', array('id' => $blogpost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
