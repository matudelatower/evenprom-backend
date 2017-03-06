<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class EmpresasRestController extends FOSRestController {

	/**
	 *
	 * obtiene las empresas activas
	 *
	 * @ApiDoc(
	 *  description="obtiene las empresas activas",
	 * )
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getEmpresasAction( Request $request ) {

		$criteria = array(
			'activo' => true
		);

		$empresas = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->findBy( $criteria );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.empresas_image' );

		$hostOnda = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/bundles/app/img/ondas/';

		foreach ( $empresas as $empresa ) {
			if ( $empresa->getImageName() ) {
				$empresa->setImageName( $host . '/' . $empresa->getImageName() );
			}
			foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
				if ( $empresaOnda->getOnda() ) {
					$empresaOnda->getOnda()->setHost( $hostOnda );
				}
			}
		}


		$vista = $this->view( $empresas,
			200 );

		return $this->handleView( $vista );
	}

	/**
	 *
	 * obtiene una empresa
	 *
	 * @ApiDoc(
	 *  description="obtiene una empresa"
	 * )
	 *
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getEmpresaAction( Request $request, $id ) {

		$empresa = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->find( $id );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.empresas_image' );

		$hostOnda = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/bundles/app/img/ondas/';

		if ( $empresa->getImageName() ) {
			$empresa->setImageName( $host . '/' . $empresa->getImageName() );
		}

		foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
			if ( $empresaOnda->getOnda() ) {
				$empresaOnda->getOnda()->setHost( $hostOnda );
			}
		}


		$vista = $this->view( $empresa,
			200 );

		return $this->handleView( $vista );
	}

	public function getEmpresasporslugPersonaAction( Request $request, $slug, $personaId ) {

		$empresas = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->findBySlugRubro( $slug );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.empresas_image' );

		$hostOnda = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/bundles/app/img/ondas/';

		foreach ( $empresas as $empresa ) {

			foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
				if ( $empresaOnda->getOnda() ) {
					$empresaOnda->getOnda()->setHost( $hostOnda );
				}
			}
			if ( $empresa->getImageName() ) {
				$empresa->setImageName( $host . '/' . $empresa->getImageName() );
			}
			foreach ( $empresa->getFavorito() as $favorito ) {
				if ( $favorito->getPersona()->getId() == $personaId &&
				     $favorito->getActivo()
				) {
					$empresa->setLikePersona( true );
				}
			}
		}

		$vista = $this->view( $empresas,
			200 );

		return $this->handleView( $vista );
	}

	public function getEmpresasPersonaAction( Request $request, $personaId ) {

		$empresas = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->findAll();

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.empresas_image' );

		$hostOnda = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/bundles/app/img/ondas/';

		foreach ( $empresas as $empresa ) {

			foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
				if ( $empresaOnda->getOnda() ) {
					$empresaOnda->getOnda()->setHost( $hostOnda );
				}
			}

			if ( $empresa->getImageName() ) {
				$empresa->setImageName( $host . '/' . $empresa->getImageName() );
			}

			foreach ( $empresa->getFavorito() as $favorito ) {
				if ( $favorito->getPersona()->getId() == $personaId &&
				     $favorito->getActivo()
				) {
					$empresa->setLikePersona( true );
				}
			}
		}


		$vista = $this->view( $empresas,
			200 );

		return $this->handleView( $vista );
	}
}
