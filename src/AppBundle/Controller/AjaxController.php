<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller {

	public function getCategoriasAction( Request $request ) {

		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository( 'AppBundle:Categoria' )->findAll();

		$json = array();

		if ( ! count( $entities ) ) {
			$json[] = array(
				'label' => 'No se encontraron coincidencias',
				'value' => ''
			);
		} else {

			foreach ( $entities as $entity ) {
				$json[] = array(
					'id'   => $entity['id'],
					//'label' => $entity[$property],
					'text' => $entity['nombre']
				);
			}
		}

		return new JsonResponse( $json );

	}

	public function getSubRubrosAction( Request $request ) {

		$rubroId   = $request->get( 'id' );
		$em        = $this->getDoctrine()->getManager();
		$rubro     = $em->getRepository( 'AppBundle:Rubro' )->find( $rubroId );
		$subRubros = $em->getRepository( 'AppBundle:SubRubro' )->findByRubro( $rubro );

		if ( ! $subRubros ) {
			$subRubros = array();
		}

		return $this->render( ':ajax:subRubros.html.twig',
			array( 'subRubros' => $subRubros ) );
	}

}
