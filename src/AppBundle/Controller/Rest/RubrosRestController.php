<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class RubrosRestController extends FOSRestController {

	public function getRubrosAction( Request $request ) {

		$criteria = array(
			'activo' => true
		);

		$locale = $request->get( 'locale' ) ? $request->get( 'locale' ) : 'es';

		$rubros = $this->getDoctrine()->getRepository( "AppBundle:Rubro" )->findBy( $criteria );


		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.rubros_image' );

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
		foreach ( $rubros as $rubro ) {
			if ( $rubro->getImageName() ) {
				$rubro->setImageName( $host . '/' . $rubro->getImageName() );
			}
			$rubro->setNombre( $rubro->$prop() );
		}

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

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.rubros_image' );

		foreach ( $rubros as $rubro ) {
			if ( $rubro->getImageName() ) {
				$rubro->setImageName( $host . '/' . $rubro->getImageName() );
			}
		}

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
