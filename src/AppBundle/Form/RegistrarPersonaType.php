<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrarPersonaType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'nombre' )
			->add( 'apellido' )
			->add( 'fechaNacimiento',
				DateType::class,
				array(
					'widget' => 'single_text',
					'format' => 'dd-MM-yyyy',
					'attr'   => array(
						'class'       => 'datepicker',
					),
				) )
			->add( 'dni' )
			->add( 'tipoDocumento' )
			->add( 'usuario', new EmpresaUsuarioType() );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class'         => 'AppBundle\Entity\Persona',
			'translation_domain' => 'app'
		) );
	}
}
