<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class NoticiasRestController extends FOSRestController {

	public function getNoticiasAction( Request $request ) {

		$noticias = $this->getDoctrine()->getRepository( "AppBundle:Noticia" )->findAll();

	
		$vista = $this->view( $noticias,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getNoticiasEmpresaAction( Request $request, $empresaId ) {

		$noticias = $this->getDoctrine()->getRepository( "AppBundle:Noticia" )->findAllByEmpresa($empresaId);


		$vista = $this->view( $noticias,
			200 )
		;

		return $this->handleView( $vista );
	}
}
