<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PublicacionesRestController extends FOSRestController {

    public function getCombosAction(Request $request) {

        $publicaciones = $this->getDoctrine()->getRepository("AppBundle:Publicacion")->findAll();

        $vista = $this->view( $publicaciones,
            200 )
//			->setTemplate( "MyBundle:Users:getUsers.html.twig" )
//			->setTemplateVar( 'noticias' )
        ;

        return $this->handleView( $vista );
    }
}
