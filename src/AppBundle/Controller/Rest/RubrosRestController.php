<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class RubrosRestController extends FOSRestController {

	public function getRubrosAction( Request $request ) {

		$rubros = $this->getDoctrine()->getRepository( "AppBundle:Rubro" )->findAll();


		$vista = $this->view( $rubros,
			200 );

		return $this->handleView( $vista );
	}

	public function getRubrosEmpresaAction( Request $request, $empresaId ) {

		$rubros = $this->getDoctrine()->getRepository( "AppBundle:Categoria" )->findAllByEmpresa( $empresaId );


		$vista = $this->view( $rubros,
			200 );

		return $this->handleView( $vista );
	}

	public function getRubrosSlugAction( Request $request, $slug ) {

		$criteria = array(
			'activo' => true,
			'slug'   => $slug
		);

		$rubros = $this->getDoctrine()->getRepository( "AppBundle:Rubro" )->findBy( $criteria );


		$vista = $this->view( $rubros,
			200 );

		return $this->handleView( $vista );
	}

	public function getSubrubrosSlugrubroAction( Request $request, $slug ) {

		$criteria = array(
			'activo' => true,
			'slug'   => $slug
		);

		$rubro = $this->getDoctrine()->getRepository( "AppBundle:Rubro" )->findBy( $criteria );

		$subRubros = $this->getDoctrine()->getRepository( "AppBundle:SubRubro" )->findByRubro( $rubro );


		$vista = $this->view( $subRubros,
			200 );

		return $this->handleView( $vista );
	}
}
