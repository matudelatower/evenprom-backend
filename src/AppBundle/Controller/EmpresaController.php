<?php

namespace AppBundle\Controller;

use AppBundle\Form\RegistrarEmpresaType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Empresa;
use AppBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 */
class EmpresaController extends Controller {
	/**
	 * Lists all Empresa entities.
	 *
	 */
	public function indexAction() {
		$em = $this->getDoctrine()->getManager();

		$empresas = $em->getRepository( 'AppBundle:Empresa' )->findAll();

		return $this->render( 'empresa/index.html.twig',
			array(
				'empresas' => $empresas,
			) );
	}

	/**
	 * Creates a new Empresa entity.
	 *
	 */
	public function newAction( Request $request ) {
		$empresa = new Empresa();
		$form    = $this->createForm( 'AppBundle\Form\EmpresaType', $empresa );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $empresa );
			$em->flush();

			return $this->redirectToRoute( 'empresa_show', array( 'id' => $empresa->getId() ) );
		}

		return $this->render( 'empresa/new.html.twig',
			array(
				'empresa' => $empresa,
				'form'    => $form->createView(),
			) );
	}

	/**
	 * Finds and displays a Empresa entity.
	 *
	 */
	public function showAction( Empresa $empresa ) {
		$deleteForm = $this->createDeleteForm( $empresa );

		return $this->render( 'empresa/show.html.twig',
			array(
				'empresa'     => $empresa,
				'delete_form' => $deleteForm->createView(),
			) );
	}

	/**
	 * Displays a form to edit an existing Empresa entity.
	 *
	 */
	public function editAction( Request $request, Empresa $empresa ) {
		$deleteForm = $this->createDeleteForm( $empresa );
		$editForm   = $this->createForm( 'AppBundle\Form\EmpresaType', $empresa );
		$editForm->handleRequest( $request );

		if ( $editForm->isSubmitted() && $editForm->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $empresa );
			$em->flush();

			return $this->redirectToRoute( 'empresa_edit', array( 'id' => $empresa->getId() ) );
		}

		return $this->render( 'empresa/edit.html.twig',
			array(
				'empresa'     => $empresa,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			) );
	}

	/**
	 * Deletes a Empresa entity.
	 *
	 */
	public function deleteAction( Request $request, Empresa $empresa ) {
		$form = $this->createDeleteForm( $empresa );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->remove( $empresa );
			$em->flush();
		}

		return $this->redirectToRoute( 'empresa_index' );
	}

	/**
	 * Creates a form to delete a Empresa entity.
	 *
	 * @param Empresa $empresa The Empresa entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm( Empresa $empresa ) {
		return $this->createFormBuilder()
		            ->setAction( $this->generateUrl( 'empresa_delete', array( 'id' => $empresa->getId() ) ) )
		            ->setMethod( 'DELETE' )
		            ->getForm();
	}

	public function registrarAction( Request $request ) {

		$empresa = new Empresa();

		$form = $this->createForm( RegistrarEmpresaType::class, $empresa );

		if ( $request->getMethod() == 'POST' ) {
			/** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
			$userManager = $this->get( 'fos_user.user_manager' );
			/** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
			$dispatcher = $this->get( 'event_dispatcher' );

			$user = $userManager->createUser();


			$event = new GetResponseUserEvent( $user, $request );
			$dispatcher->dispatch( FOSUserEvents::REGISTRATION_INITIALIZE, $event );

			if ( null !== $event->getResponse() ) {
				return $event->getResponse();
			}

			$form->handleRequest( $request );

			if ( $form->isValid() ) {
				$event = new FormEvent( $form, $request );
				$dispatcher->dispatch( FOSUserEvents::REGISTRATION_SUCCESS, $event );

				$user = $empresa->getUsuario();
				$empresa->getUsuario()->addRole( 'ROLE_EMPRESA' );
				$empresa->getUsuario()->setEnabled( true );

				$userManager->updateUser( $user );

				if ( null === $response = $event->getResponse() ) {
					$url = $this->generateUrl( 'fos_user_security_login' );
					$em  = $this->getDoctrine()->getManager();
					$em->persist( $empresa );
					$em->flush();
					$response = new RedirectResponse( $url );
				}

				$dispatcher->dispatch( FOSUserEvents::REGISTRATION_COMPLETED,
					new FilterUserResponseEvent( $user, $request, $response ) );


				return $response;
			}
		}

		return $this->render( ':empresa:registrar.html.twig',
			array(
				'form' => $form->createView(),
			)
		);
	}

	public function perfilAction( Request $request ) {

		$empresa = $this->getUser()->getEmpresa()->first();

		$form = $this->createForm( EmpresaType::class, $empresa );

		if ( $request->getMethod() == 'POST' ) {

			$form->handleRequest( $request );
			if ( $form->isValid() ) {
				$em = $this->getDoctrine()->getManager();

				$em->persist( $empresa );
				$em->flush();
				$this->get( 'session' )->getFlashBag()->add(
					'success',
					$this->get( 'translator' )->trans( '%entity% Actualizado Correctamente',
						array( '%entity%' => 'Perfil' ),
						'flashes' )
				);
			}
		}


		return $this->render( ':empresa:perfil.html.twig',
			array(
				'empresa' => $empresa,
				'form'    => $form->createView(),
			) );
	}
}
