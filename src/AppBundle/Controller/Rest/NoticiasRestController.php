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

	public function getNoticiasEmpresaAction( Request $request, $empresaId ) {

		$empresa = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->find($empresaId);

		$noticias = $this->getDoctrine()->getRepository( "AppBundle:NoticiaEmpresa" )->findByNoticiasByEmpresa( $empresa );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.noticias_image' );

		$retorno = array();

		foreach ( $noticias as $noticia ) {

			if ( $noticia->getNoticia()->getImageName() ) {
				$noticia->getNoticia()->setImageName( $host . '/' . $noticia->getNoticia()->getImageName() );
			}

            $retorno [] = $noticia->getNoticia();
		}

		$vista = $this->view( $retorno,
			200 );

		return $this->handleView( $vista );
	}
}
