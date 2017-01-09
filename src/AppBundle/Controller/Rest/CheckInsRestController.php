<?php

namespace AppBundle\Controller\Rest;


use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class CheckInsRestController extends FOSRestController {


	public function postCheckinEmpresaAction( Request $request, $empresaId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$checkIn = $appManager->checkInEmpresa( $empresaId, $personaId );

		if ( $checkIn->getPersona()->getId() == $personaId &&
		     $checkIn->getActivo()
		) {
			$checkIn->getEmpresa()->setCheckInPersona( true );
		}

		$vista = $this->view( $checkIn,
			200 );

		return $this->handleView( $vista );
	}

	public function postCheckinPublicacionAction( Request $request, $publicacionId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$checkIn = $appManager->checkInPublicacion( $publicacionId, $personaId );

		if ( $checkIn->getPersona()->getId() == $personaId &&
		     $checkIn->getActivo()
		) {
			$checkIn->getPublicacion()->setCheckInPersona( true );
		}

		$vista = $this->view( $checkIn,
			200 );

		return $this->handleView( $vista );
	}

	public function getCheckinsPersonasAction( Request $request, $personaId ) {

		$persona   = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->find( $personaId );
		$checkIns = $this->getDoctrine()->getRepository( "AppBundle:CheckIn" )->findByPersona( $persona );


		$vista = $this->view( $checkIns,
			200 );

		return $this->handleView( $vista );
	}
}
