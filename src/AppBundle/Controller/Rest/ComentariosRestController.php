<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\RegistroLlamadaEmpresa;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ComentariosRestController extends FOSRestController {


	public function postComentarEmpresaAction( Request $request, $empresaId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$params = $request->request->all();
		$texto  = $params['texto'];

		$comentario = $appManager->comentarEmpresa( $empresaId, $personaId, $texto );

		$vista = $this->view( $comentario,
			200 );

		return $this->handleView( $vista );
	}

	public function postComentarPublicacionAction( Request $request, $publicacionId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$params = $request->request->all();
		$texto  = $params['texto'];

		$comentario = $appManager->comentarPublicacion( $publicacionId, $personaId, $texto );

		$vista = $this->view( $comentario,
			200 );

		return $this->handleView( $vista );
	}

	public function getComentariosEmpresaAction( Request $request, $empresaId ) {

		$empresa = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->find( $empresaId );

		$criteria = array(
			'empresa' => $empresa
		);

		$comentarios = $this->getDoctrine()->getRepository( "AppBundle:Comentario" )->findBy( $criteria );


		$vista = $this->view( $comentarios,
			200 );

		return $this->handleView( $vista );
	}

	public function getComentariosPublicacionAction( Request $request, $publicacionId ) {

		$publicacion = $this->getDoctrine()->getRepository( "AppBundle:Publicacion" )->find( $publicacionId );

		$criteria = array(
			'publicacion' => $publicacion
		);

		$comentarios = $this->getDoctrine()->getRepository( "AppBundle:Comentario" )->findBy( $criteria );


		$vista = $this->view( $comentarios,
			200 );

		return $this->handleView( $vista );
	}
}
