<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class RubrosRestController extends FOSRestController {

	public function getRubrosAction( Request $request ) {

		$rubros = $this->getDoctrine()->getRepository( "AppBundle:Rubro" )->findAll();

	
		$vista = $this->view( $rubros,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getRubrosEmpresaAction( Request $request, $empresaId ) {

		$rubros = $this->getDoctrine()->getRepository( "AppBundle:Categoria" )->findAllByEmpresa($empresaId);


		$vista = $this->view( $rubros,
			200 )
		;

		return $this->handleView( $vista );
	}
}
