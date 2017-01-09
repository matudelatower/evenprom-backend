<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FotoPersonaEmpresaType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'empresa' )
			->add( 'persona' )
			->add( 'imageFile',
				VichImageType::class,
				array(
					'required'      => false,
					'allow_delete'  => true, // not mandatory, default is true
					'download_link' => true, // not mandatory, default is true
				) );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class'      => 'AppBundle\Entity\FotoPersonaEmpresa',
			'csrf_protection' => false
		) );
	}
}
