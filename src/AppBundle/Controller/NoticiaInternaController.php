<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\NoticiaInterna;

/**
 * NoticiaInterna controller.
 *
 */
class NoticiaInternaController extends Controller
{
    /**
     * Lists all NoticiaInterna entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $noticiaInternas = $em->getRepository('AppBundle:NoticiaInterna')->findAll();

        return $this->render('noticiainterna/index.html.twig', array(
            'noticiaInternas' => $noticiaInternas,
        ));
    }

    /**
     * Finds and displays a NoticiaInterna entity.
     *
     */
    public function showAction(NoticiaInterna $noticiaInterna)
    {

        return $this->render('noticiainterna/show.html.twig', array(
            'noticiaInterna' => $noticiaInterna,
        ));
    }
}
