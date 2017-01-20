<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlanEmpresa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlanEmpresaController extends Controller {

	public function indexAction( Request $request ) {

		$em = $this->getDoctrine()->getManager();

		$criteria = array( 'activo' => true );

		$planes = $em->getRepository( 'AppBundle:Plan' )->findBy( $criteria );

		$empresa = $this->getUser()->getEmpresa()->first();

		$planEmpresa = $em->getRepository( 'AppBundle:PlanEmpresa' )->findPlanActivoByEmpresa( $empresa );

		return $this->render( ':planempresa:index.html.twig',
			array(
				'planes'      => $planes,
				'planEmpresa' => $planEmpresa,
			)
		);
	}

	public function basicAction( Request $request ) {

		$em = $this->getDoctrine()->getManager();

		$empresa = $this->getUser()->getEmpresa()->first();

		$planEmpresa = $em->getRepository( 'AppBundle:PlanEmpresa' )->findByEmpresa( $empresa );

		$fechaActual = new \DateTime( 'now' );

		foreach ( $planEmpresa as $item ) {
			if ( $item->getPlan()->getSlug() == 'basic' ) {
				if ( $item->getVencimiento() > $fechaActual ) {
					$this->get( 'session' )->getFlashBag()->add(
						'warning',
						$this->get( 'translator' )->trans( '%entity%',
							array( '%entity%' => 'Tu Plan está activo hasta el ' . $item->getVencimiento()->format( 'd/m/Y' ) ),
							'flashes' )
					);

					return $this->redirectToRoute( 'plan_empresa_index' );
				} else {
					$this->get( 'session' )->getFlashBag()->add(
						'warning',
						$this->get( 'translator' )->trans( '%entity%',
							array( '%entity%' => 'Ya utilizaste el plan básico. Ahora adquirí algun Plan Pago.' ),
							'flashes' )
					);
					$empresa->setPremium( false );

					$em->persist( $empresa );

					return $this->redirectToRoute( 'plan_empresa_index' );
				}
			}
		}

		$planBasic = $em->getRepository( 'AppBundle:Plan' )->findOneBySlug( 'basic' );

		$planEmpresa = new PlanEmpresa();


		$vencimiento = $fechaActual->add( new \DateInterval( 'P' . $planBasic->getPeriodo() . 'D' ) );

		$planEmpresa->setVencimiento( $vencimiento );
		$planEmpresa->setEmpresa( $empresa );
		$planEmpresa->setPlan( $planBasic );
		$planEmpresa->setActivo( true );
		$empresa->setPremium( true );

		$em->persist( $planEmpresa );
		$em->persist( $empresa );
		$em->flush();

		$this->get( 'session' )->getFlashBag()->add(
			'success',
			$this->get( 'translator' )->trans( '%entity%',
				array( '%entity%' => 'Pago Basico Adquirido Correctamente' ),
				'flashes' )
		);

		return $this->render( ':planempresa:plan_success.html.twig',
			array() );
	}

	public function plusAction( Request $request ) {

		$em = $this->getDoctrine()->getManager();

		$empresa = $this->getUser()->getEmpresa()->first();

		$planPlus = $em->getRepository( 'AppBundle:Plan' )->findOneBySlug( 'plus' );

		$planEmpresa = new PlanEmpresa();

		$fechaActual = new \DateTime( 'now' );
		$vencimiento = $fechaActual->add( new \DateInterval( 'P' . $planPlus->getPeriodo() . 'D' ) );

		$planEmpresa->setVencimiento( $vencimiento );
		$planEmpresa->setEmpresa( $empresa );
		$planEmpresa->setPlan( $planPlus );
		$planEmpresa->setActivo( true );

		$em->persist( $planEmpresa );
		$em->flush();

		$this->get( 'session' )->getFlashBag()->add(
			'success',
			$this->get( 'translator' )->trans( '%entity%',
				array( '%entity%' => 'Pago Plus Adquirido Correctamente' ),
				'flashes' )
		);

		return $this->render( ':planempresa:plan_success.html.twig',
			array() );
	}

	public function premiumAction( Request $request ) {

		$em = $this->getDoctrine()->getManager();

		$empresa = $this->getUser()->getEmpresa()->first();

		$planPremium = $em->getRepository( 'AppBundle:Plan' )->findOneBySlug( 'premium' );

		$planEmpresa = new PlanEmpresa();

		$fechaActual = new \DateTime( 'now' );
		$vencimiento = $fechaActual->add( new \DateInterval( 'P' . $planPremium->getPeriodo() . 'D' ) );

		$planEmpresa->setVencimiento( $vencimiento );
		$planEmpresa->setEmpresa( $empresa );
		$planEmpresa->setPlan( $planPremium );
		$planEmpresa->setActivo( true );

		$em->persist( $planEmpresa );
		$em->flush();

		$this->get( 'session' )->getFlashBag()->add(
			'success',
			$this->get( 'translator' )->trans( '%entity%',
				array( '%entity%' => 'Pago Premium Adquirido Correctamente' ),
				'flashes' )
		);

		return $this->render( ':planempresa:plan_success.html.twig',
			array() );
	}
}
