<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class OndasRestController extends FOSRestController {

	public function getOndasAction( Request $request ) {

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Onda" )->findAll();

	
		$vista = $this->view( $categorias,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getOndasEmpresaAction( Request $request, $empresaId ) {

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Onda" )->findAllByEmpresa($empresaId);


		$vista = $this->view( $categorias,
			200 )
		;

		return $this->handleView( $vista );
	}
}
