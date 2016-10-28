<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class UbicacionRestController extends FOSRestController {

	public function getPaisesAction( Request $request ) {

		$paises = $this->getDoctrine()->getRepository( "UbicacionBundle:Pais" )->findAll();

	
		$vista = $this->view( $paises,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getProvinciasPaisAction( Request $request, $paisId ) {

		$pais = $this->getDoctrine()->getRepository( "UbicacionBundle:Pais" )->find($paisId);

		$provincias = $this->getDoctrine()->getRepository( "UbicacionBundle:Provincia" )->findAllByPais($pais);


		$vista = $this->view( $provincias,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getDepartamentosProvinciaAction( Request $request, $provinciaId ) {

		$provincia = $this->getDoctrine()->getRepository( "UbicacionBundle:Provincia" )->find($provinciaId);

		$departamentos = $this->getDoctrine()->getRepository( "UbicacionBundle:Departamento" )->findAllByProvincia($provincia);


		$vista = $this->view( $departamentos,
			200 )
		;

		return $this->handleView( $vista );
	}

	public function getLocalidadesDepartamentoAction( Request $request, $departamentoId ) {

		$departamento = $this->getDoctrine()->getRepository( "UbicacionBundle:Departamento" )->find($departamentoId);

		$lodalidad = $this->getDoctrine()->getRepository( "UbicacionBundle:Localidad" )->findAllByDepartamento($departamento);


		$vista = $this->view( $lodalidad,
			200 )
		;

		return $this->handleView( $vista );
	}
}
