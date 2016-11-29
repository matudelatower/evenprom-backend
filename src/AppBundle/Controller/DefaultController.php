<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
	public function indexAction( Request $request ) {

		$em = $this->getDoctrine();
		if ( ! $this->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ||
		     $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_USUARIO' ) ||
		     $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_PERSONA' )) {

			$publicaciones = $em->getRepository( "AppBundle:Publicacion" )->findAll();

			return $this->render( 'AppBundle:Default:index.html.twig',
				array(
					'publicaciones' => $publicaciones
				) );

		}

		if ( $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_ADMIN' ) ) {
			return $this->redirectToRoute( 'easyadmin' );
		}

		$empresa = $this->getUser()->getEmpresa()->first();


		$noticias                = $em->getRepository( 'AppBundle:NoticiaInterna' )->getNoticiasActuales();
		$noticiasInternasEmpresa = $em->getRepository( 'AppBundle:NoticiaInternaEmpresa' )->findByEmpresa( $empresa );

		return $this->render( ':empresa:empresa_admin.html.twig',
			array(
				'empresa'                 => $empresa,
				'noticias'                => $noticias,
				'noticiasInternasEmpresa' => $noticiasInternasEmpresa,
			) );

	}

	public function indexSitiosAction( Request $request ) {

		$em = $this->getDoctrine();

		$empresas = $em->getRepository( 'AppBundle:Empresa' )->findAll();

		return $this->render( '@App/Default/sitios.html.twig',
			array(
				'empresas' => $empresas
			) );
	}

	public function sitiosAction( Request $request, $id ) {
		$em = $this->getDoctrine();

		$empresa = $em->getRepository( 'AppBundle:Empresa' )->find( $id );

		return $this->render( '@App/Default/perfil_empresa.html.twig',
			array(
				'empresa' => $empresa
			) );
	}
}
