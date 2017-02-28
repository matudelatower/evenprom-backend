<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\NotificacionPersona;
use AppBundle\Entity\PersonaOnda;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PersonaOndaRestController extends FOSRestController {

	public function getOndasAction($personaId) {

		$em = $this->getDoctrine()->getManager();

		$persona = $em->getRepository('AppBundle:Persona')->findOneById($personaId);

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$ondas = $em->getRepository( "AppBundle:PersonaOnda" )->findByPersona($persona);


		$vista = $this->view( $ondas,
			200 );

		return $this->handleView( $vista );
	}


}
