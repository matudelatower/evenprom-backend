<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UtilBundle\Form\Type\BootstrapCollectionType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PublicacionType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'titulo' )
			->add( 'descripcion' )
			->add( 'cuerpo',
				CKEditorType::class,
				array(
					'config' => array(//'uiColor' => '#ffffff',
					),
				) )
			->add( 'fechaInicio',
				DateType::class,
				array(
					'widget' => 'single_text',
					'format' => 'dd-MM-yyyy',
					'attr'   => array(
						'class' => 'datepicker',
					),
				) )->add( 'fechaFin',
				DateType::class,
				array(
					'widget' => 'single_text',
					'format' => 'dd-MM-yyyy',
					'attr'   => array(
						'class' => 'datepicker',
					),
				) )
			->add( 'horaInicio',
				TimeType::class,
				array(
					'required' => false,
					'widget'   => 'single_text',
					'data'     => null,
					'attr'     => array(
						'class' => 'timepicker'
					)
				) )
			->add( 'horaFin',
				TimeType::class,
				array(
					'required' => false,
					'widget'   => 'single_text',
					'attr'     => array(
						'class' => 'timepicker'
					)
				) )
			->add( 'tipoPublicacion' )
			->add( 'categoriaPublicacion',
				BootstrapCollectionType::class,
				array(
					'entry_type'   => CategoriaPublicacionType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false
				) )
			->add( 'imageFile',
				VichImageType::class,
				array(
					'label'         => 'image.publicacion',
					'required'      => false,
					'allow_delete'  => true, // not mandatory, default is true
					'download_link' => true, // not mandatory, default is true
				) )
			->add( 'descuentoPublicacion',
				BootstrapCollectionType::class,
				array(
					'entry_type'   => DescuentoPublicacionType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'max_items_add'=> 1
				) )
			->add( 'publicado' )
		;
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class' => 'AppBundle\Entity\Publicacion'
		) );
	}
}
