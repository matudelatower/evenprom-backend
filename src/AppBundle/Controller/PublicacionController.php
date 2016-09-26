<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategoriaPublicacion;
use AppBundle\Entity\DescuentoPublicacion;
use AppBundle\Entity\PublicacionEmpresa;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Publicacion;
use AppBundle\Form\PublicacionType;

/**
 * Publicacion controller.
 *
 */
class PublicacionController extends Controller {
	/**
	 * Lists all Publicacion entities.
	 *
	 */
	public function indexAction() {
		$em = $this->getDoctrine()->getManager();

		$empresa = $this->getUser()->getEmpresa()->first();

		$publicacions = $em->getRepository( 'AppBundle:Publicacion' )->findAllByEmpresa( $empresa );

		return $this->render( 'publicacion/index.html.twig',
			array(
				'publicacions' => $publicacions,
			) );
	}

	/**
	 * Creates a new Publicacion entity.
	 *
	 */
	public function newAction( Request $request ) {
		$publicacion          = new Publicacion();
		$categoriaPublicacion = new CategoriaPublicacion();
		$publicacion->addCategoriaPublicacion( $categoriaPublicacion );
		$form = $this->createForm( 'AppBundle\Form\PublicacionType', $publicacion );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();

			$publicacionEmpresa = new PublicacionEmpresa();
			$publicacionEmpresa->setPublicacion( $publicacion );
			$empresa = $this->getUser()->getEmpresa()->first();
			$publicacionEmpresa->setEmpresa( $empresa );
			$publicacion->addPublicacionEmpresa( $publicacionEmpresa );

			$em->persist( $publicacion );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Creado Correctamente',
					array( '%entity%' => 'Publicacion' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'publicaciones_show', array( 'id' => $publicacion->getId() ) );
		}

		return $this->render( 'publicacion/new.html.twig',
			array(
				'publicacion' => $publicacion,
				'form'        => $form->createView(),
			) );
	}

	/**
	 * Finds and displays a Publicacion entity.
	 *
	 */
	public function showAction( Publicacion $publicacion ) {
		$deleteForm = $this->createDeleteForm( $publicacion );

		return $this->render( 'publicacion/show.html.twig',
			array(
				'publicacion' => $publicacion,
				'delete_form' => $deleteForm->createView(),
			) );
	}

	/**
	 * Displays a form to edit an existing Publicacion entity.
	 *
	 */
	public function editAction( Request $request, Publicacion $publicacion ) {
		$deleteForm = $this->createDeleteForm( $publicacion );
		$editForm   = $this->createForm( 'AppBundle\Form\PublicacionType', $publicacion );
		$editForm->handleRequest( $request );

		if ( $editForm->isSubmitted() && $editForm->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $publicacion );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Actualizado Correctamente',
					array( '%entity%' => 'Publicacion' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'publicaciones_edit', array( 'id' => $publicacion->getId() ) );
		}

		return $this->render( 'publicacion/edit.html.twig',
			array(
				'publicacion' => $publicacion,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			) );
	}

	/**
	 * Deletes a Publicacion entity.
	 *
	 */
	public function deleteAction( Request $request, Publicacion $publicacion ) {
		$form = $this->createDeleteForm( $publicacion );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->remove( $publicacion );
			$em->flush();
		}

		return $this->redirectToRoute( 'publicaciones_index' );
	}

	/**
	 * Creates a form to delete a Publicacion entity.
	 *
	 * @param Publicacion $publicacion The Publicacion entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm( Publicacion $publicacion ) {
		return $this->createFormBuilder()
		            ->setAction( $this->generateUrl( 'publicaciones_delete', array( 'id' => $publicacion->getId() ) ) )
		            ->setMethod( 'DELETE' )
		            ->getForm();
	}

	/**
	 * Creates a new Oferta.
	 *
	 */
	public function nuevaOfertaAction( Request $request ) {
		$publicacion          = new Publicacion();
		$descuentoPublicacion = new DescuentoPublicacion();
		$publicacion->addDescuentoPublicacion( $descuentoPublicacion );

		$em = $this->getDoctrine()->getManager();

		$tipoPublicacion = $em->getRepository( 'AppBundle:TipoPublicacion' )->findOneBySlug( 'oferta' );

		$publicacion->setTipoPublicacion( $tipoPublicacion );

		$form = $this->createForm( 'AppBundle\Form\OfertaType', $publicacion );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {


			$publicacionEmpresa = new PublicacionEmpresa();
			$publicacionEmpresa->setPublicacion( $publicacion );
			$empresa = $this->getUser()->getEmpresa()->first();
			$publicacionEmpresa->setEmpresa( $empresa );
			$publicacion->addPublicacionEmpresa( $publicacionEmpresa );

			$em->persist( $publicacion );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Creado Correctamente',
					array( '%entity%' => 'Oferta' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'publicaciones_show', array( 'id' => $publicacion->getId() ) );
		}

		return $this->render( 'publicacion/new_oferta.html.twig',
			array(
				'publicacion' => $publicacion,
				'form'        => $form->createView(),
			) );
	}

	/**
	 * Displays a form to edit an existing Offerta.
	 *
	 */
	public function editarOfertaAction( Request $request, Publicacion $publicacion ) {

		$editForm = $this->createForm( 'AppBundle\Form\OfertaType', $publicacion );
		$editForm->handleRequest( $request );

		if ( $editForm->isSubmitted() && $editForm->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $publicacion );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Actualizado Correctamente',
					array( '%entity%' => 'Oferta' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'oferta_edit', array( 'id' => $publicacion->getId() ) );
		}

		return $this->render( 'publicacion/edit_oferta.html.twig',
			array(
				'publicacion' => $publicacion,
				'edit_form'   => $editForm->createView(),
			) );
	}

	/**
	 * Creates a new Publicacion entity.
	 *
	 */
	public function nuevoEventoAction( Request $request ) {
		$publicacion = new Publicacion();
		$em          = $this->getDoctrine()->getManager();

		$tipoPublicacion = $em->getRepository( 'AppBundle:TipoPublicacion' )->findOneBySlug( 'evento' );

		$publicacion->setTipoPublicacion( $tipoPublicacion );

		$form = $this->createForm( 'AppBundle\Form\EventoType', $publicacion );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {

			$publicacionEmpresa = new PublicacionEmpresa();
			$publicacionEmpresa->setPublicacion( $publicacion );
			$empresa = $this->getUser()->getEmpresa()->first();
			$publicacionEmpresa->setEmpresa( $empresa );
			$publicacion->addPublicacionEmpresa( $publicacionEmpresa );

			$em->persist( $publicacion );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Creado Correctamente',
					array( '%entity%' => 'Evento' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'publicaciones_show', array( 'id' => $publicacion->getId() ) );
		}

		return $this->render( 'publicacion/new_evento.html.twig',
			array(
				'publicacion' => $publicacion,
				'form'        => $form->createView(),
			) );
	}

	/**
	 * Displays a form to edit an existing Evento.
	 *
	 */
	public function editarEventoAction( Request $request, Publicacion $publicacion ) {

		$editForm = $this->createForm( 'AppBundle\Form\EventoType', $publicacion );
		$editForm->handleRequest( $request );

		if ( $editForm->isSubmitted() && $editForm->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $publicacion );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Actualizado Correctamente',
					array( '%entity%' => 'Evento' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'evento_edit', array( 'id' => $publicacion->getId() ) );
		}

		return $this->render( 'publicacion/edit_evento.html.twig',
			array(
				'publicacion' => $publicacion,
				'edit_form'   => $editForm->createView(),
			) );
	}


}
