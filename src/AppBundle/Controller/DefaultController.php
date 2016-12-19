<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
	public function indexAction( Request $request ) {


		if ( ! $this->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ||
		     $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_USUARIO' ) ||
		     $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_PERSONA' )
		) {

			return $this->redirectToRoute( 'app_index' );

		}

		if ( $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_ADMIN' ) ) {
			return $this->redirectToRoute( 'easyadmin' );
		}

		return $this->redirectToRoute( 'empresa_admin' );


	}

	public function indexSitiosAction( Request $request ) {

		$em = $this->getDoctrine();

		$empresas = $em->getRepository( 'AppBundle:Empresa' )->findAll();

		$categorias = $em->getRepository( 'AppBundle:Categoria' )->findAll();

		return $this->render( '@App/Default/sitios.html.twig',
			array(
				'empresas'   => $empresas,
				'categorias' => $categorias
			) );
	}

	public function sitiosAction( Request $request, $id ) {
		$em = $this->getDoctrine();

		$empresa = $em->getRepository( 'AppBundle:Empresa' )->find( $id );

		$comentarios = $em->getRepository( 'AppBundle:Comentario' )->findUltimosComentariosByEmpresa( $empresa );

		return $this->render( '@App/Default/perfil_empresa.html.twig',
			array(
				'empresa' => $empresa,
				'comentarios'=>$comentarios
			) );
	}

	public function indexAppAction( Request $request ) {

		$em            = $this->getDoctrine();
		$publicaciones = $em->getRepository( "AppBundle:Publicacion" )->findAll();

		return $this->render( 'AppBundle:Default:index.html.twig',
			array(
				'publicaciones' => $publicaciones
			) );
	}
}
