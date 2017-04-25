<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class OndasRestController extends FOSRestController {

	public function getOndasAction( Request $request ) {

		$criteria = array( 'activo' => true );

		$locale = $request->get( 'locale' ) ? $request->get( 'locale' ) : 'es';

		switch ( $locale ) {
			case 'en':
				$prop = 'getEn';
				break;
			case 'pt':
				$prop = 'getPt';
				break;
			default:
				$prop = 'getNombre';
		}

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Onda" )->findBy( $criteria );

		foreach ( $categorias as $categoria ) {
			$categoria->setNombre( $categoria->$prop() );
		}


		$vista = $this->view( $categorias,
			200 );

		return $this->handleView( $vista );
	}

	public function getOndasEmpresaAction( Request $request, $empresaId ) {

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Onda" )->findAllByEmpresa( $empresaId );


		$vista = $this->view( $categorias,
			200 );

		return $this->handleView( $vista );
	}
}
