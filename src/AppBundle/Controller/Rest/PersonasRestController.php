<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PersonasRestController extends FOSRestController {

	public function getPersonasAction( Request $request ) {

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->findAll();

	
		$vista = $this->view( $categorias,
			200 )
		;

		return $this->handleView( $vista );
	}
}
