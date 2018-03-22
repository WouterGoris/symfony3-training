<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blogpost;
use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Blog controller.
 *
 * @Route("blog")
 */
class BlogController extends Controller
{
/**
     * Finds and displays a blog entity.
     *
     * @Route("/", name="blog_index")
     * @Method("GET")
     */

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $blogposts = $em->getRepository('AppBundle:Blogpost')->findAll();

        return $this->render('blog/index.html.twig', array(
            'blogposts' => $blogposts,
        ));
    }
    /**
     * Finds and displays a blog entity.
     *
     * @Route("/{id}", name="blog_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, Blogpost $blogpost)
    {
        $comment = new Comment();
        $comment->setBlogpost($blogpost);

        $commentForm = $this->createForm(CommentType::class, $comment);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()){
            $comment = $commentForm->getData();

            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blogpost_show', ['id' => $blogpost->getId()]);
        }

            $comments = $blogpost->getComments();

        return $this->render('blog/show.html.twig', array(
            'blogpost' => $blogpost,
            'comment_form' => $commentForm->createView(),
            'comments' => $comments,
        ));
    }


}
