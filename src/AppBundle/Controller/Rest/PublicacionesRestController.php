<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PublicacionesRestController extends FOSRestController {

	public function getPublicacionesAction( Request $request ) {

		$publicaciones = $this->getDoctrine()->getRepository( "AppBundle:Publicacion" )->findActuales();

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.publicaciones_image' );

		foreach ( $publicaciones as $publicacione ) {
			if ( $publicacione->getImageName() ) {
				$publicacione->setImageName( $host . '/' . $publicacione->getImageName() );
			}
		}


		$vista = $this->view( $publicaciones,
			200 );

		return $this->handleView( $vista );
	}

	public function getPublicacionesPersonaAction( Request $request, $personaId ) {

		$publicaciones = $this->getDoctrine()->getRepository( "AppBundle:Publicacion" )->findActuales();


		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.publicaciones_image' );

		foreach ( $publicaciones as $publicacione ) {
			if ( $publicacione->getImageName() ) {
				$publicacione->setImageName( $host . '/' . $publicacione->getImageName() );
			}

			foreach ( $publicacione->getFavorito() as $favorito ) {
				if ( $favorito->getPersona()->getId() == $personaId &&
				     $favorito->getActivo()
				) {
					$publicacione->setLikePersona( true );
				}
			}


		}


		$vista = $this->view( $publicaciones,
			200 );

		return $this->handleView( $vista );
	}

	public function getPublicacionesporempresaAction( Request $request, $empresaId ) {

		$empresa = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->find( $empresaId );

		$publicaciones = $this->getDoctrine()->getRepository( "AppBundle:Publicacion" )->findActualesByEmpresa( $empresa );

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

		$promosCalendario = $this->getDoctrine()->getRepository( "AppBundle:PromocionCalendario" )->findActualesAdquiridas();

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.publicaciones_image' );

		foreach ( $promosCalendario as $promoCalendario ) {
			if ( $promoCalendario->getImageName() ) {
				$promoCalendario->setImageName( $host . '/' . $promoCalendario->getImageName() );
			}
		}

		$vista = $this->view( $promosCalendario,
			200 );

		return $this->handleView( $vista );
	}


}
