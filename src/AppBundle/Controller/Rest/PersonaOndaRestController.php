<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\NotificacionPersona;
use AppBundle\Entity\PersonaOnda;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PersonaOndaRestController extends FOSRestController {

	public function getOndasAction( Request $request, $personaId ) {

		$em = $this->getDoctrine()->getManager();

		$persona = $em->getRepository( 'AppBundle:Persona' )->findOneById( $personaId );

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$hostOnda = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/bundles/app/img/ondas/';

		$personaOndas = $em->getRepository( "AppBundle:PersonaOnda" )->findByPersona( $persona );

		foreach ( $personaOndas as $personaOnda ) {
			$personaOnda->getOnda()->setHost( $hostOnda );
		}


		$vista = $this->view( $personaOndas,
			200 );

		return $this->handleView( $vista );
	}


}
