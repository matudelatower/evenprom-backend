<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\RegistroLlamadaEmpresa;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class FavoritosRestController extends FOSRestController {


	public function postFavearEmpresaAction( Request $request, $empresaId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$favorito = $appManager->favearEmpresa( $empresaId, $personaId );

		$vista = $this->view( $favorito,
			200 );

		return $this->handleView( $vista );
	}

	public function postFavearPublicacionAction( Request $request, $publicacionId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$favorito = $appManager->favearPublicacion( $publicacionId, $personaId );

		$vista = $this->view( $favorito,
			200 );

		return $this->handleView( $vista );
	}
}
