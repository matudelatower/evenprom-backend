<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class EmpresasRestController extends FOSRestController {

	public function getEmpresasAction( Request $request ) {

		$empresas = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->findAll();

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.empresas_image' );

		$hostOnda = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/bundles/app/img/ondas/';

		foreach ( $empresas as $empresa ) {
			if ( $empresa->getImageName() ) {
				$empresa->setImageName( $host . '/' . $empresa->getImageName() );
			}
			foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
				if ( $empresaOnda->getOnda() ) {
					$empresaOnda->getOnda()->setIcono( $hostOnda . $empresaOnda->getOnda()->getIcono() . '-only.png' );
				}
			}
		}


		$vista = $this->view( $empresas,
			200 );

		return $this->handleView( $vista );
	}

	public function getEmpresaAction( Request $request, $id ) {

		$empresa = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->find( $id );

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter( 'app.path.empresas_image' );

		$hostOnda = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/bundles/app/img/ondas/';

		if ( $empresa->getImageName() ) {
			$empresa->setImageName( $host . '/' . $empresa->getImageName() );
		}

		foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
			if ( $empresaOnda->getOnda() ) {
				$empresaOnda->getOnda()->setIcono( $hostOnda . $empresaOnda->getOnda()->getIcono() . '-only.png' );
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
			if ( $empresa->getImageName() ) {
				$empresa->setImageName( $host . '/' . $empresa->getImageName() );
			}
			foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
				if ( $empresaOnda->getOnda() ) {
					$empresaOnda->getOnda()->setIcono( $hostOnda . $empresaOnda->getOnda()->getIcono() . '-only.png' );
				}
			}
			if ( $empresa->getFavorito()->count() > 0 &&
			     $empresa->getFavorito()->last()->getPersona()->getId() == $personaId &&
			     $empresa->getFavorito()->last()->getActivo()
			) {
				$empresa->setLikePersona( true );
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
			if ( $empresa->getImageName() ) {
				$empresa->setImageName( $host . '/' . $empresa->getImageName() );
			}
			foreach ( $empresa->getEmpresaOnda() as $empresaOnda ) {
				if ( $empresaOnda->getOnda() ) {
					$empresaOnda->getOnda()->setIcono( $hostOnda . $empresaOnda->getOnda()->getIcono() . '-only.png' );
				}
			}
			if ( $empresa->getFavorito()->count() > 0 &&
			     $empresa->getFavorito()->last()->getPersona()->getId() == $personaId &&
			     $empresa->getFavorito()->last()->getActivo()
			) {
				$empresa->setLikePersona( true );
			}
		}


		$vista = $this->view( $empresas,
			200 );

		return $this->handleView( $vista );
	}
}
