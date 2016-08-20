<?php

namespace AppBundle\Form;

use AppBundle\Form\EventListener\AddRubroFieldSubscriber;
use AppBundle\Form\EventListener\AddSubRubroFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaSubRubroType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$factory = $builder->getFormFactory();

//		$builder
//			->add( 'subRubro' );

		$builder->addEventSubscriber( new AddRubroFieldSubscriber( $factory ) );
		$builder->addEventSubscriber( new AddSubRubroFieldSubscriber( $factory ) );

	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class' => 'AppBundle\Entity\EmpresaSubRubro'
		) );
	}
}
