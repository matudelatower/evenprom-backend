<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\PromocionCalendario;
use AppBundle\Form\PromocionCalendarioType;

/**
 * PromocionCalendario controller.
 *
 */
class PromocionCalendarioController extends Controller {
	/**
	 * Lists all PromocionCalendario entities.
	 *
	 */
	public function indexAction() {
		$em                   = $this->getDoctrine()->getManager();
		$empresa              = $this->getUser()->getEmpresa()->first();
		$promocionCalendarios = $em->getRepository( 'AppBundle:PromocionCalendario' )->findPromosByEmpresa( $empresa );

		return $this->render( 'promocioncalendario/index.html.twig',
			array(
				'promocionCalendarios' => $promocionCalendarios,
			) );
	}

	/**
	 * Creates a new PromocionCalendario entity.
	 *
	 */
	public function newAction( Request $request ) {
		$promocionCalendario = new PromocionCalendario();
		$form                = $this->createForm( 'AppBundle\Form\PromocionCalendarioType', $promocionCalendario );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $promocionCalendario );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Creado Correctamente',
					array( '%entity%' => 'PromocionCalendario' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'promocion_calendario_show',
				array( 'id' => $promocionCalendario->getId() ) );
		}

		return $this->render( 'promocioncalendario/new.html.twig',
			array(
				'promocionCalendario' => $promocionCalendario,
				'form'                => $form->createView(),
			) );
	}

	/**
	 * Finds and displays a PromocionCalendario entity.
	 *
	 */
	public function showAction( PromocionCalendario $promocionCalendario ) {
		$deleteForm = $this->createDeleteForm( $promocionCalendario );

		return $this->render( 'promocioncalendario/show.html.twig',
			array(
				'promocionCalendario' => $promocionCalendario,
				'delete_form'         => $deleteForm->createView(),
			) );
	}

	/**
	 * Displays a form to edit an existing PromocionCalendario entity.
	 *
	 */
	public function editAction( Request $request, PromocionCalendario $promocionCalendario ) {
		$editForm   = $this->createForm( 'AppBundle\Form\PromocionCalendarioType', $promocionCalendario );
		$editForm->handleRequest( $request );

		if ($promocionCalendario->getEmpresa() !==  $empresa = $this->getUser()->getEmpresa()->first()){

			$this->get( 'session' )->getFlashBag()->add(
				'error',
				$this->get( 'translator' )->trans( '%entity%',
					array( '%entity%' => 'No puedes editar una promocion que no te pertenece.' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'promocion_calendario_index' );
		}

		if ( $editForm->isSubmitted() && $editForm->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $promocionCalendario );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Actualizado Correctamente',
					array( '%entity%' => 'Promoción Calendario' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'promocion_calendario_edit',
				array( 'id' => $promocionCalendario->getId() ) );
		}

		return $this->render( 'promocioncalendario/edit.html.twig',
			array(
				'promocionCalendario' => $promocionCalendario,
				'edit_form'           => $editForm->createView(),
			) );
	}

	/**
	 * Deletes a PromocionCalendario entity.
	 *
	 */
	public function deleteAction( Request $request, PromocionCalendario $promocionCalendario ) {
		$form = $this->createDeleteForm( $promocionCalendario );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->remove( $promocionCalendario );
			$em->flush();
		}

		return $this->redirectToRoute( 'promocion_calendario_index' );
	}

	/**
	 * Creates a form to delete a PromocionCalendario entity.
	 *
	 * @param PromocionCalendario $promocionCalendario The PromocionCalendario entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm( PromocionCalendario $promocionCalendario ) {
		return $this->createFormBuilder()
		            ->setAction( $this->generateUrl( 'promocion_calendario_delete',
			            array( 'id' => $promocionCalendario->getId() ) ) )
		            ->setMethod( 'DELETE' )
		            ->getForm();
	}

	public function adquirirAction( Request $request, $id ) {

		$em = $this->getDoctrine()->getManager();

		$empresa = $this->getUser()->getEmpresa()->first();

		if ( ! $empresa ) {
			$this->get( 'warning' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity%',
					array( '%entity%' => 'No existe la empresa' ),
					'flashes' )
			);
			return $this->redirectToRoute( 'empresa_admin' );
		}

		$promoCalendario = $em->getRepository( 'AppBundle:PromocionCalendario' )->find( $id );

		if ( ! $promoCalendario ) {
			$this->get( 'warning' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity%',
					array( '%entity%' => 'No existe la promoción calendario' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'empresa_admin' );
		}

		$promoCalendario->setEmpresa( $empresa );

		$em->persist($promoCalendario);
		$em->flush();


		$this->get( 'session' )->getFlashBag()->add(
			'success',
			$this->get( 'translator' )->trans( '%entity% Adquirida Correctamente',
				array( '%entity%' => 'Promocion Calendario' ),
				'flashes' )
		);

		return $this->redirectToRoute( 'empresa_admin' );
	}
}
