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

		$datos = json_decode( $request->get( 'fields' ) );

		$publicaciones = $this->getDoctrine()->getRepository( "AppBundle:Publicacion" )->findActuales( $datos );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.publicaciones_image' );

		foreach ( $publicaciones as $publicacione ) {
			if ( $publicacione->getImageName() ) {
				$publicacione->setImageName( $host . '/' . $publicacione->getImageName() );
			}

			foreach ( $publicacione->getFavorito() as $favorito ) {
				if ( $favorito->getPersona() && $favorito->getPersona()->getId() == $personaId &&
				     $favorito->getActivo()
				) {
					$publicacione->setLikePersona( true );
				}
			}

			foreach ( $publicacione->getCheckIn() as $checkIn ) {
				if ( $checkIn->getPersona() && $checkIn->getPersona()->getId() == $personaId &&
				     $checkIn->getActivo()
				) {
					$publicacione->setCheckInPersona( true );
				}
			}

		}

		$vista = $this->view( $publicaciones,
			200 );

		return $this->handleView( $vista );
	}

	public function getPublicacionPersonaAction( Request $request, $personaId, $publicacionId ) {

		$em = $this->getDoctrine();

		$publicacione = $em->getRepository( 'AppBundle:Publicacion' )->findOneById( $publicacionId );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.publicaciones_image' );

		if ( $publicacione->getImageName() ) {
			$publicacione->setImageName( $host . '/' . $publicacione->getImageName() );
		}

		foreach ( $publicacione->getFavorito() as $favorito ) {
			if ( $favorito->getPersona() && $favorito->getPersona()->getId() == $personaId &&
			     $favorito->getActivo()
			) {
				$publicacione->setLikePersona( true );
			}
		}

		foreach ( $publicacione->getCheckIn() as $checkIn ) {
			if ( $checkIn->getPersona() && $checkIn->getPersona()->getId() == $personaId &&
			     $checkIn->getActivo()
			) {
				$publicacione->setCheckInPersona( true );
			}
		}

		$vista = $this->view( $publicacione,
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
