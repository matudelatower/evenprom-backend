<?php

namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class UbicacionRestController extends FOSRestController {

	public function getPaisesAction( Request $request ) {

		$paises = $this->getDoctrine()->getRepository( "UbicacionBundle:Pais" )->findAll();


		$vista = $this->view( $paises,
			200 );

		return $this->handleView( $vista );
	}

	public function getProvinciasPaisAction( Request $request, $paisId ) {

		$pais = $this->getDoctrine()->getRepository( "UbicacionBundle:Pais" )->find( $paisId );

		$provincias = $this->getDoctrine()->getRepository( "UbicacionBundle:Provincia" )->findAllByPais( $pais );


		$vista = $this->view( $provincias,
			200 );

		return $this->handleView( $vista );
	}

	public function getDepartamentosProvinciaAction( Request $request, $provinciaId ) {

		$provincia = $this->getDoctrine()->getRepository( "UbicacionBundle:Provincia" )->find( $provinciaId );

		$departamentos = $this->getDoctrine()->getRepository( "UbicacionBundle:Departamento" )->findAllByProvincia( $provincia );


		$vista = $this->view( $departamentos,
			200 );

		return $this->handleView( $vista );
	}

	public function getLocalidadesDepartamentoAction( Request $request, $departamentoId ) {

		$departamento = $this->getDoctrine()->getRepository( "UbicacionBundle:Departamento" )->find( $departamentoId );

		$lodalidad = $this->getDoctrine()->getRepository( "UbicacionBundle:Localidad" )->findAllByDepartamento( $departamento );


		$vista = $this->view( $lodalidad,
			200 );

		return $this->handleView( $vista );
	}

	public function getLocalidadesPublicacionesAction( Request $request ) {

		$sql = "SELECT DISTINCT localidades.id, localidades.descripcion
				FROM     publicaciones_empresas 
				INNER JOIN publicaciones  ON publicaciones_empresas.publicacion_id = publicaciones.id 
				INNER JOIN empresas  ON publicaciones_empresas.empresa_id = empresas.id 
				INNER JOIN direcciones_empresas  ON direcciones_empresas.empresa_id = empresas.id 
				INNER JOIN direcciones  ON direcciones_empresas.direccion_id = direcciones.id 
				INNER JOIN localidades  ON direcciones.localidad_id = localidades.id ";

//		$fechaActual = new \DateTime( 'now' );

//		$sql .= "WHERE publicaciones.fecha_inicio >= '" . $fechaActual->format( 'Y-m-d' ) . " 00:00:00'";
//		$sql .= " AND publicaciones.fecha_fin <= '" . $fechaActual->format( 'Y-m-d' ) . " 23:59:59'";
//		$sql .= " AND publicaciones.publicado = true";


		$em   = $this->getDoctrine()->getManager();
		$stmt = $em->getConnection()
		           ->prepare( $sql );
		$stmt->execute();
		$localidades = $stmt->fetchAll();


		$vista = $this->view( $localidades,
			200 );

		return $this->handleView( $vista );
	}
}
