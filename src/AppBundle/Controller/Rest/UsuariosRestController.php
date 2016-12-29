<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class UsuariosRestController extends FOSRestController {


	public function getUsuariosAction() {
		$usuarios = $this->getDoctrine()->getRepository( "UsuariosBundle:Usuario" )->findAll();


		$vista = $this->view( $usuarios,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function postRegistrarAction( Request $request) {

		$usuariosManager = $this->get('manager.usuario');

		$params = $request->request->all();

		$usuario = $usuariosManager->crearPerfil($params);

		$vista = $this->view( $usuario,
			200 );

		return $this->handleView( $vista );
	}
}
