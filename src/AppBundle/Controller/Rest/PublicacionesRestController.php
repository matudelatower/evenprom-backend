<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PublicacionesRestController extends FOSRestController {

	public function getPublicacionesAction( Request $request ) {

		$publicaciones = $this->getDoctrine()->getRepository( "AppBundle:Publicacion" )->findAll();

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.publicaciones_image' );

		foreach ( $publicaciones as $publicacione ) {
			if ( $publicacione->getImageName() ) {
				$publicacione->setImageName( $host . '/' . $publicacione->getImageName() );
			}
		}


		$vista = $this->view( $publicaciones,
			200 )
//			->setTemplate( "MyBundle:Users:getUsers.html.twig" )
//			->setTemplateVar( 'noticias' )
		;

		return $this->handleView( $vista );
	}

	public function getPublicacionesporempresaAction( Request $request, $empresaId ) {

		$publicaciones = $this->getDoctrine()->getRepository( "AppBundle:Publicacion" )->findAllByEmpresa( $empresaId );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.publicaciones_image' );

		foreach ( $publicaciones as $publicacione ) {
			if ( $publicacione->getImageName() ) {
				$publicacione->setImageName( $host . '/' . $publicacione->getImageName() );
			}
		}


		$vista = $this->view( $publicaciones,
			200 )
//			->setTemplate( "MyBundle:Users:getUsers.html.twig" )
//			->setTemplateVar( 'noticias' )
		;

		return $this->handleView( $vista );
	}

	public function getPromoCalendarioAction( Request $request ) {

		$promoCalenadario = array();

		$vista = $this->view( $promoCalenadario,
			200 );

		return $this->handleView( $vista );
	}


}
