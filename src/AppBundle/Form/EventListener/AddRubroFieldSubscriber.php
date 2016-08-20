<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 24/2/16
 * Time: 5:19 PM
 */

namespace AppBundle\Form\EventListener;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AddRubroFieldSubscriber implements EventSubscriberInterface {

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

	private function addRubroForm( $form, $rubro ) {

		$form->add( $this->factory->createNamed( 'rubro',
			'entity',
			$rubro,
			array(
				'class'           => 'AppBundle:Rubro',
				'auto_initialize' => false,
				'empty_value'     => 'Seleccionar',
				'mapped'          => false,
				'attr'            => array(
					'class' => 'select_rubro select2',
				),
				'query_builder'   => function ( EntityRepository $repository ) {
					$qb = $repository->createQueryBuilder( 'rubro' );

					return $qb;
				}
			) ) );
	}

	public function preSetData( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			$this->addRubroForm( $form, null );

			return;
		}

		$accessor = PropertyAccess::createPropertyAccessor();

		$subRubro    = $accessor->getValue( $data, 'subRubro' );
		$rubro         = ( $subRubro ) ? $subRubro->getRubro() : null;

		$this->addRubroForm( $form, $rubro );
	}

	public function preSubmit( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			return;
		}
		$rubro = array_key_exists( 'rubro', $data ) ? $data['rubro'] : null;
		$this->addRubroForm( $form, $rubro );
	}

}
