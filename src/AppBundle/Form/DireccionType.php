<?php

namespace AppBundle\Form;

use Matudelatower\UbicacionBundle\Form\EventListener\AddDepartamentoFieldSubscriber;
use Matudelatower\UbicacionBundle\Form\EventListener\AddLocalidadFieldSubscriber;
use Matudelatower\UbicacionBundle\Form\EventListener\AddPaisFieldSubscriber;
use Matudelatower\UbicacionBundle\Form\EventListener\AddProvinciaFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DireccionType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$factory = $builder->getFormFactory();


		$builder
			->add( 'calle' )
			->add( 'altura' )
			->add( 'piso' )
			->add( 'edificio' )
			->add( 'lat', HiddenType::class ,
				array(
					'attr' => array( 'class' => 'direccion-lat' )
				) )
			->add( 'lng',
				HiddenType::class,
				array(
					'attr' => array( 'class' => 'direccion-lng' )
				) );
		$builder->addEventSubscriber( new AddPaisFieldSubscriber( $factory ) );
		$builder->addEventSubscriber( new AddProvinciaFieldSubscriber( $factory ) );
		$builder->addEventSubscriber( new AddDepartamentoFieldSubscriber( $factory ) );
		$builder->addEventSubscriber( new AddLocalidadFieldSubscriber( $factory ) );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class' => 'AppBundle\Entity\Direccion'
		) );
	}
}
