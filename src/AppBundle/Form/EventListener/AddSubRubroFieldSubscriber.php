<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 24/2/16
 * Time: 5:17 PM
 */

namespace AppBundle\Form\EventListener;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;


class AddSubRubroFieldSubscriber implements EventSubscriberInterface {

	private $factory;

	public function __construct( FormFactoryInterface $factory ) {
		$this->factory = $factory;
	}

	public static function getSubscribedEvents() {
		return array(
			FormEvents::PRE_SET_DATA => 'preSetData',
			FormEvents::PRE_SUBMIT   => 'preSubmit'
		);
	}

	private function addSubRubroForm( $form, $subRubro, $rubro ) {

		$form->add( $this->factory->createNamed( 'subRubro',
			'entity',
			$subRubro,
			array(
				'class'           => 'AppBundle:SubRubro',
				'auto_initialize' => false,
				'empty_value'     => 'Seleccionar',
				'attr'            => array(
					'class' => 'select_sub_rubro select2',
				),
				'query_builder'   => function ( EntityRepository $repository ) use ( $rubro ) {
					$qb = $repository->createQueryBuilder( 'subRubro' );
					$qb->innerJoin( 'subRubro.rubro', 'rubro' )
					   ->where( 'rubro = :rubro' )
					   ->setParameter( 'rubro', $rubro );

					return $qb;
				}
			) ) );
	}

	public function preSetData( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			$this->addSubRubroForm( $form, null, null );

			return;
		}

		$accessor  = PropertyAccess::createPropertyAccessor();
		$subRubro = $accessor->getValue( $data, 'subRubro' );
		$rubro      = ( $subRubro ) ? $subRubro->getRubro() : null;

		$this->addSubRubroForm( $form, $subRubro, $rubro );

	}

	public function preSubmit( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			return;
		}
		$subRubro = array_key_exists( 'subRubro', $data ) ? $data['subRubro'] : null;
		$rubro      = array_key_exists( 'rubro', $data ) ? $data['rubro'] : null;
		$this->addSubRubroForm( $form, $subRubro, $rubro );
	}

}
