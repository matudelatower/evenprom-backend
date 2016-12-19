<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comentario;
use AppBundle\Entity\NoticiaInternaEmpresa;
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

	public function noticiaMarcarLeidaAction( Request $request ) {

		$noticiaInternaId = $request->get( 'id' );

		$em = $this->getDoctrine()->getManager();

		$noticiaInterna = $em->getRepository( 'AppBundle:NoticiaInterna' )->find( $noticiaInternaId );

		$empresa = $this->getUser()->getEmpresa()->first();

		$criteria = array(
			'empresa'        => $empresa,
			'noticiaInterna' => $noticiaInterna
		);

		$noticiaInternaEmpresa = $em->getRepository( 'AppBundle:NoticiaInternaEmpresa' )->findOneBy( $criteria );

		if ( $noticiaInternaEmpresa ) {
			$leido = ! $noticiaInternaEmpresa->getLeido();
			$noticiaInternaEmpresa->setLeido( $leido );
			if ( ! $noticiaInternaEmpresa->getLeidoEl() ) {
				$noticiaInternaEmpresa->setLeidoEl( new \DateTime( 'now' ) );
			}
		} else {
			$noticiaInternaEmpresa = new NoticiaInternaEmpresa();
			$noticiaInternaEmpresa->setLeidoEl( new \DateTime( 'now' ) );
			$leido = true;
			$noticiaInternaEmpresa->setLeido( $leido );
			$noticiaInternaEmpresa->setNoticiaInterna( $noticiaInterna );
			$noticiaInternaEmpresa->setEmpresa( $empresa );
			$em->persist( $noticiaInternaEmpresa );
		}

		$em->flush();

		$json = array(
			'leido' => $leido
		);

		return new JsonResponse( $json );
	}

	public function verPublicacionAction( Request $request ) {

		$publicacionId = $request->get( 'id' );

		$em = $this->getDoctrine()->getManager();

		$publicacion = $em->getRepository( 'AppBundle:Publicacion' )->find( $publicacionId );

		return $this->render( 'ajax/publicacion.html.twig',
			array(
				'publicacion' => $publicacion
			)
		);

	}

	public function comentarPerfilEmpresa( Request $request, $empresaId, $personaId ) {


		$em = $this->getDoctrine()->getManager();

		$empresa = $em->getRepository( 'AppBundle:Empresa' )->find( $empresaId );
		$persona = $em->getRepository( 'AppBundle:Empresa' )->find( $personaId );

		if ( ! $persona ) {

			return new JsonResponse( array(
				'text' => 'La Persona no existe o no esta logueado',
			), 404 );
		}

		$comentario = new Comentario();
		$comentario->setTexto();
		$comentario->setEmpresa( $empresa );
		$comentario->setPersona( $persona );

		$em->persist( $comentario );
		$em->flush();

		return new JsonResponse( array(
			'text' => 'Comentario Guardado Correctamente',
		) );
	}

}
