<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class EmpresasRestController extends FOSRestController {

	public function getEmpresasAction( Request $request ) {

		$empresas = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->findAll();

		$host = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->getParameter('app.path.empresas_image');

		foreach ( $empresas as $empresa ) {
			if ( $empresa->getImageName() ) {
				$empresa->setImageName( $host . $empresa->getImageName() );
			}
		}


		$vista = $this->view( $empresas,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getEmpresaAction( Request $request, $id ) {

		$empresas = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->find($id);


		$vista = $this->view( $empresas,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getEmpresasporslugAction( Request $request, $slug ) {

		$empresas = $this->getDoctrine()->getRepository( "AppBundle:Empresa" )->findBySlugCategoria($slug);


		$vista = $this->view( $empresas,
			200 )
		;

		return $this->handleView( $vista );
	}
}
