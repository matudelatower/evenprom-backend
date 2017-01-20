<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UtilBundle\Form\Type\BootstrapCollectionType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class OfertaType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$maxLength = 12;


		$builder
			->add( 'titulo',
				TextType::class,
				array(
					'attr'  => array(
						'placeholder' => "Recomendado $maxLength caracteres",
						'maxlength'   => $maxLength,
						'help_text'   => 'Por ej "pastas, vinos, etc"'
					),
					'label' => 'nombre.oferta'
				) )
			->add( 'descripcion',
				TextType::class,
				array(
					'attr' => array(
						'placeholder' => "Recomendado $maxLength caracteres",
						'maxlength'   => $maxLength,
					),
				) )
			->add( 'imageFile',
				VichImageType::class,
				array(
					'label'         => 'image.publicacion',
					'required'      => false,
					'allow_delete'  => true, // not mandatory, default is true
					'download_link' => true, // not mandatory, default is true
				) )
			->add( 'fechaInicio',
				DateType::class,
				array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy',
					'attr'   => array(
						'class'       => 'datepicker',
						'placeholder' => "Fecha de inicio de la oferta ",
					),
				) )
			->add( 'fechaFin',
				DateType::class,
				array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy',
					'attr'   => array(
						'class'       => 'datepicker',
						'placeholder' => "Fecha de fin de la oferta ",
					),
				) )
			->add( 'fechaPublicacion',
				TextType::class,
				array(
					'mapped' => false,
					'attr'   => array(
						'class'       => 'multidatepicker',
						'placeholder' => "Fecha de en la que aparecerá la publicación",
					),
				) )
			->add( 'descuentoPublicacion',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => DescuentoPublicacionType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
					'max_items_add' => 1
				) )
			->add( 'cuerpo',
				CKEditorType::class,
				array(
					'config'  => array(//'uiColor' => '#ffffff',
						'extraPlugins' => 'confighelper',
					),
					'plugins' => array(
						'confighelper' => array(
							'path'     => '/bundles/app/js/confighelper/',
							'filename' => 'plugin.js',
						),
					),
					'attr'    => array(
						'placeholder' => 'Las condiciones de la oferta'
					),
				) )
			->add( 'publicado' );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class'         => 'AppBundle\Entity\Publicacion',
			'translation_domain' => 'app'
		) );
	}
}
