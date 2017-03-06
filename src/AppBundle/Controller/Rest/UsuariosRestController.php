<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class UsuariosRestController extends FOSRestController {


	public function getUsuariosAction() {
		$usuarios = $this->getDoctrine()->getRepository( "UsuariosBundle:Usuario" )->findAll();


		$vista = $this->view( $usuarios,
			200 );

		return $this->handleView( $vista );
	}

	public function postRegistrarAction( Request $request ) {

		$usuariosManager = $this->get( 'manager.usuario' );

		$params = $request->request->all();

		$usuario = $usuariosManager->crearPerfil( $params );

//		$clientManager = $this->container->get( 'fos_oauth_server.client_manager.default' );
//		$client        = $clientManager->createClient();
//		$client->setRedirectUris( array( $redirectUri ) );
//		$client->setAllowedGrantTypes( array( 'token', 'authorization_code' ) );
//		$clientManager->updateClient( $client );


		$vista = $this->view( $usuario ,
			200 );

		return $this->handleView( $vista );
	}
}
