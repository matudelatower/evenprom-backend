<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class CategoriasRestController extends FOSRestController {

	public function getCategoriasAction( Request $request ) {

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Categoria" )->findAll();

	
		$vista = $this->view( $categorias,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getCategoriasEmpresaAction( Request $request, $empresaId ) {

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Categoria" )->findAllByEmpresa($empresaId);


		$vista = $this->view( $categorias,
			200 )
		;

		return $this->handleView( $vista );
	}
}
