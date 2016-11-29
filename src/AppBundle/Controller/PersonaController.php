<?php

namespace AppBundle\Controller;

use AppBundle\Form\RegistrarPersonaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;

use AppBundle\Entity\Persona;
use AppBundle\Form\PersonaType;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller {
	/**
	 * Lists all Persona entities.
	 *
	 */
	public function indexAction() {
		$em = $this->getDoctrine()->getManager();

		$personas = $em->getRepository( 'AppBundle:Persona' )->findAll();

		return $this->render( 'persona/index.html.twig',
			array(
				'personas' => $personas,
			) );
	}
	
	/**
	 * Creates a new Persona entity.
	 *
	 */
	public function newAction( Request $request ) {
		$persona = new Persona();
		$form    = $this->createForm( 'AppBundle\Form\PersonaType', $persona );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $persona );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Creado Correctamente',
					array( '%entity%' => 'Persona' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'persona_show', array( 'id' => $persona->getId() ) );
		}

		return $this->render( 'persona/new.html.twig',
			array(
				'persona' => $persona,
				'form'    => $form->createView(),
			) );
	}

	/**
	 * Finds and displays a Persona entity.
	 *
	 */
	public function showAction( Persona $persona ) {
		$deleteForm = $this->createDeleteForm( $persona );

		return $this->render( 'persona/show.html.twig',
			array(
				'persona'     => $persona,
				'delete_form' => $deleteForm->createView(),
			) );
	}

	/**
	 * Displays a form to edit an existing Persona entity.
	 *
	 */
	public function editAction( Request $request, Persona $persona ) {
		$deleteForm = $this->createDeleteForm( $persona );
		$editForm   = $this->createForm( 'AppBundle\Form\PersonaType', $persona );
		$editForm->handleRequest( $request );

		if ( $editForm->isSubmitted() && $editForm->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $persona );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( '%entity% Actualizado Correctamente',
					array( '%entity%' => 'Persona' ),
					'flashes' )
			);

			return $this->redirectToRoute( 'persona_edit', array( 'id' => $persona->getId() ) );
		}

		return $this->render( 'persona/edit.html.twig',
			array(
				'persona'     => $persona,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			) );
	}

	/**
	 * Deletes a Persona entity.
	 *
	 */
	public function deleteAction( Request $request, Persona $persona ) {
		$form = $this->createDeleteForm( $persona );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->remove( $persona );
			$em->flush();
		}

		return $this->redirectToRoute( 'persona_index' );
	}

	/**
	 * Creates a form to delete a Persona entity.
	 *
	 * @param Persona $persona The Persona entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm( Persona $persona ) {
		return $this->createFormBuilder()
		            ->setAction( $this->generateUrl( 'persona_delete', array( 'id' => $persona->getId() ) ) )
		            ->setMethod( 'DELETE' )
		            ->getForm();
	}

	public function registrarAction( Request $request ) {
		$persona = new Persona();

		$form = $this->createForm( RegistrarPersonaType::class, $persona );

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

				$user = $persona->getUsuario();
				$persona->getUsuario()->addRole( 'ROLE_USUARIO' );
				$persona->getUsuario()->setEnabled( true );

				$userManager->updateUser( $user );

				if ( null === $response = $event->getResponse() ) {
					$url = $this->generateUrl( 'app_homepage' );
					$em  = $this->getDoctrine()->getManager();
					$em->persist( $persona );
					$em->flush();
					$response = new RedirectResponse( $url );
				}

				$dispatcher->dispatch( FOSUserEvents::REGISTRATION_COMPLETED,
					new FilterUserResponseEvent( $user, $request, $response ) );


				return $response;
			}
		}

		return $this->render( ':persona:registrar.html.twig',
			array(
				'form' => $form->createView(),
			)
		);
	}

	public function perfilAction( Request $request ) {

		/* @var $persona Persona */
		$persona = $this->getUser()->getPersona()->first();

		
		$form = $this->createForm( PersonaType::class, $persona );


		if ( $request->getMethod() == 'POST' ) {

			$form->handleRequest( $request );
			if ( $form->isValid() ) {
				$em = $this->getDoctrine()->getManager();

				$em->persist( $persona );
				$em->flush();
				$this->get( 'session' )->getFlashBag()->add(
					'success',
					$this->get( 'translator' )->trans( '%entity% Actualizado Correctamente',
						array( '%entity%' => 'Perfil' ),
						'flashes' )
				);
			}
		}


		return $this->render( ':persona:perfil.html.twig',
			array(
				'persona' => $persona,
				'form'    => $form->createView(),
			) );
	}
}
