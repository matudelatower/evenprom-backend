<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\RegistroLlamadaEmpresa;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class FavoritosRestController extends FOSRestController {


	public function postFavearEmpresaAction( Request $request, $empresaId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$favorito = $appManager->favearEmpresa( $empresaId, $personaId );

		if ( $favorito->getPersona()->getId() == $personaId &&
		     $favorito->getActivo()
		) {
			$favorito->getEmpresa()->setLikePersona( true );
		}

		$vista = $this->view( $favorito,
			200 );

		return $this->handleView( $vista );
	}

	public function postFavearPublicacionAction( Request $request, $publicacionId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$favorito = $appManager->favearPublicacion( $publicacionId, $personaId );

		if ( $favorito->getPersona()->getId() == $personaId &&
		     $favorito->getActivo()
		) {
			$favorito->getPublicacion()->setLikePersona( true );
		}

		$vista = $this->view( $favorito,
			200 );

		return $this->handleView( $vista );
	}

	public function getFavoritosPersonasAction( Request $request, $personaId ) {

		$persona   = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->find( $personaId );
		$favoritos = $this->getDoctrine()->getRepository( "AppBundle:Favorito" )->findByPersona( $persona );


		$vista = $this->view( $favoritos,
			200 );

		return $this->handleView( $vista );
	}
}
