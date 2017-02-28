<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class TiposDocumentoRestController extends FOSRestController {

	public function getTipodocumentosAction( Request $request ) {

		$criteria = array( 'activo' => true );

		$tipoDocumento = $this->getDoctrine()->getRepository( "AppBundle:TipoDocumento" )->findBy( $criteria );


		$vista = $this->view( $tipoDocumento,
			200 );

		return $this->handleView( $vista );
	}

	public function getTipodocumentoAction( Request $request, $id ) {

		$criteria = array(
			'id' => $id
		);

		$tipoDocumento = $this->getDoctrine()->getRepository( "AppBundle:TipoDocumento" )->findOneBy( $criteria );


		$vista = $this->view( $tipoDocumento,
			200 );

		return $this->handleView( $vista );
	}
}
