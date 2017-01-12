<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class DescuentosRestController extends FOSRestController {

	public function getDescuentosAction( Request $request ) {

		$criteria = array(
			'activo' => true
		);

		$descuentos = $this->getDoctrine()->getRepository( "AppBundle:Descuento" )->findBy( $criteria );


		$vista = $this->view( $descuentos,
			200 );

		return $this->handleView( $vista );
	}
}
