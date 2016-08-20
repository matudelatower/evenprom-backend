<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UtilBundle\Form\Type\BootstrapCollectionType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EmpresaType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'nombre' )
			->add( 'descripcion' )
			->add( 'color',
				TextType::class,
				array(
					'attr'  => array( 'class' => 'colorpicker' ),
					'label' => 'Color Empresa'
				) )
			->add( 'linkYoutube',
				UrlType::class,
				array(
					'required' => false
				) )
			->add( 'linkFacebook',
				UrlType::class,
				array(
					'required' => false
				) )
			->add( 'linkTwitter',
				UrlType::class,
				array(
					'required' => false
				) )
			->add( 'linkInstagram',
				UrlType::class,
				array(
					'required' => false
				) )
			->add( 'imageFile',
				VichImageType::class,
				array(
					'required'      => false,
					'allow_delete'  => true, // not mandatory, default is true
					'download_link' => true, // not mandatory, default is true
					'label'         => 'Logo'
				) )
			->add( 'direccionEmpresa',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => DireccionEmpresaType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
					'max_items_add' => 1
				)
			)
			->add( 'contactoEmpresa',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => ContactoEmpresaType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
					'max_items_add' => 1
				)
			)
			->add( 'categoriaEmpresa',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => CategoriaEmpresaType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
					'max_items_add' => 1
				) )
			->add( 'empresaOnda',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => EmpresaOndaType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
				) )

			->add( 'empresaSubRubro',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => EmpresaSubRubroType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
				) )
			->add( 'empresaHotelAgencia',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => EmpresaHotelAgenciaType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
					'max_items_add' => 1
				) )
		;
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class'         => 'AppBundle\Entity\Empresa',
			'translation_domain' => 'app'
		) );
	}
}
