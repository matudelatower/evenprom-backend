<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Comentario;

/**
 * Comentario controller.
 *
 */
class ComentarioController extends Controller {
	/**
	 * Lists all Comentario entities.
	 *
	 */
	public function indexAction() {
		$em = $this->getDoctrine()->getManager();

		$empresa = $this->getUser()->getEmpresa()->first();

		$comentarios = $em->getRepository( 'AppBundle:Comentario' )->findActivosByEmpresa( $empresa );

		return $this->render( 'comentario/index.html.twig',
			array(
				'comentarios' => $comentarios,
			) );
	}

	public function verComentariosPublicacionAction( $id ) {
		$em = $this->getDoctrine()->getManager();

		$publicacion = $em->getRepository( 'AppBundle:Publicacion' )->find( $id );
		$comentarios = $em->getRepository( 'AppBundle:Comentario' )->findActivosByPublicacion( $publicacion );

		return $this->render( 'comentario/index.html.twig',
			array(
				'comentarios' => $comentarios,
			) );
	}

	/**
	 * Finds and displays a Comentario entity.
	 *
	 */
	public function showAction( Comentario $comentario ) {

		return $this->render( 'comentario/show.html.twig',
			array(
				'comentario' => $comentario,
			) );
	}
}
