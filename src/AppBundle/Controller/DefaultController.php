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

			return $this->redirectToRoute( 'app_inicio' );

		}

		if ( $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_ADMIN' ) ) {
			return $this->redirectToRoute( 'easyadmin' );
		}

		return $this->redirectToRoute( 'empresa_admin' );


	}

	public function indexSitiosAction( Request $request, $rubro = null ) {

		$em = $this->getDoctrine();

		$favoritos = array();

		if ( $this->getUser() && $this->getUser()->getPersona() ) {
			$favoritos = $em->getRepository( "AppBundle:Favorito" )->findEmpresasFavoritas(
				$this->getUser()->getPersona()->first()
			);
		}

		if ( $rubro ) {

			$empresas = $em->getRepository( 'AppBundle:Empresa' )->findBySlugRubro( $rubro );
		} else {

			$empresas = $em->getRepository( 'AppBundle:Empresa' )->findAll();

		}
		$rubros = $em->getRepository( 'AppBundle:Rubro' )->findAll();

		return $this->render( '@App/Default/sitios.html.twig',
			array(
				'empresas'  => $empresas,
				'rubros'    => $rubros,
				'favoritos' => $favoritos,
			) );
	}

	public function sitiosAction( Request $request, $id ) {
		$em = $this->getDoctrine();

		$empresa = $em->getRepository( 'AppBundle:Empresa' )->find( $id );

		$favoritos = array();
		if ( $this->getUser() && $this->getUser()->getPersona() ) {
			$criteria  = array(
				'persona' => $this->getUser()->getPersona()->first(),
				'empresa' => $empresa
			);
			$favoritos = $em->getRepository( "AppBundle:Favorito" )->findBy( $criteria );
		}

		$comentarios = $em->getRepository( 'AppBundle:Comentario' )->findUltimosComentariosByEmpresa( $empresa );

		$noticias = $em->getRepository( 'AppBundle:NoticiaEmpresa' )->findByNoticiasByEmpresa( $empresa );

		$fotosPersonaEmpresa = $em->getRepository( 'AppBundle:FotoPersonaEmpresa' )->findByEmpresa( $empresa );

		return $this->render( '@App/Default/perfil_empresa.html.twig',
			array(
				'empresa'             => $empresa,
				'comentarios'         => $comentarios,
				'noticiasEmpresa'     => $noticias,
				'favoritos'           => $favoritos,
				'fotosPersonaEmpresa' => $fotosPersonaEmpresa,
			) );
	}

	public function indexAppAction( Request $request, $empresa = null ) {

		$em = $this->getDoctrine();

		$favoritos = array();

		if ( $this->getUser() && $this->getUser()->getPersona() ) {
			$favoritos = $em->getRepository( "AppBundle:Favorito" )->findPublicacionesFavoritas(
				$this->getUser()->getPersona()->first()
			);
		}

		if ( $empresa ) {
			$oEmpresa      = $em->getRepository( "AppBundle:Empresa" )->find( $empresa );
			$publicaciones = $em->getRepository( "AppBundle:Publicacion" )->findActualesByEmpresa( $oEmpresa );
		} else {
			$publicaciones = $em->getRepository( "AppBundle:Publicacion" )->findActuales();
		}

		$promoCalendario = $em->getRepository( 'AppBundle:PromocionCalendario' )->findActualesAdquiridas();

		$rubros = $em->getRepository( 'AppBundle:Rubro' )->findAll();


		return $this->render( 'AppBundle:Default:index.html.twig',
			array(
				'publicaciones'   => $publicaciones,
				'promoCalendario' => $promoCalendario,
				'favoritos'       => $favoritos,
				'rubros'          => $rubros,
			) );
	}
}
