<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class NoticiasRestController extends FOSRestController {

	public function getNoticiasAction( Request $request ) {

		$noticias = $this->getDoctrine()->getRepository( "AppBundle:Noticia" )->findAll();


		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.noticias_image' );

		foreach ( $noticias as $noticia ) {
			if ( $noticia->getImageName() ) {
				$noticia->setImageName( $host . '/' . $noticia->getImageName() );
			}
		}

		$vista = $this->view( $noticias,
			200 );

		return $this->handleView( $vista );
	}

	public function getNoticiasEmpresaAction( Request $request, $noticiaId ) {

		$noticias = $this->getDoctrine()->getRepository( "AppBundle:Noticia" )->findAllByEmpresa( $noticiaId );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.noticias_image' );

		foreach ( $noticias as $noticia ) {
			if ( $noticia->getImageName() ) {
				$noticia->setImageName( $host . '/' . $noticia->getImageName() );
			}
		}

		$vista = $this->view( $noticias,
			200 );

		return $this->handleView( $vista );
	}
}
