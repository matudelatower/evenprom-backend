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
			->add( 'descripcion',
				TextType::class,
				array(
					'attr'     => array(
						'help_text' => 'Por ej si su empresa es Macowens, la descripcion sería: Ropa Formal',
					),
					'required' => false,
				) )
			->add( 'cuit',
				null,
				array(
					'label' => 'CUIT/CPF/CPNJ'
				) )
			->add( 'color',
				TextType::class,
				array(
					'attr'  => array( 'class' => 'colorpicker' ),
					'label' => 'color.empresa'
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
					'max_items_add' => 1,
					'label_attr'    => array( 'class' => 'text-green h2' )
				)
			)
			->add( 'contactoEmpresa',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => ContactoEmpresaType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
					'max_items_add' => 1,
					'label_attr'    => array( 'class' => 'text-green h2' )
				)
			)
//			->add( 'categoriaEmpresa',
//				BootstrapCollectionType::class,
//				array(
//					'entry_type'    => CategoriaEmpresaType::class,
//					'allow_add'     => true,
//					'allow_delete'  => true,
//					'by_reference'  => false,
//					'max_items_add' => 1,
//					'label'         => 'Rubro',
//					'label_attr'    => array( 'class' => 'text-green h2' )
//				) )
			->add( 'empresaOnda',
				BootstrapCollectionType::class,
				array(
					'entry_type'   => EmpresaOndaType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Onda de la Empresa',
					'label_attr'   => array( 'class' => 'text-green h2' )
				) )
			->add( 'empresaSubRubro',
				BootstrapCollectionType::class,
				array(
					'entry_type'   => EmpresaSubRubroType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Rubro',
					'label_attr'   => array( 'class' => 'text-green h2' )
				) )
			->add( 'empresaHotelAgencia',
				BootstrapCollectionType::class,
				array(
					'entry_type'    => EmpresaHotelAgenciaType::class,
					'allow_add'     => true,
					'allow_delete'  => true,
					'by_reference'  => false,
					'max_items_add' => 1,
					'label'         => 'Tu empresas es un hotel o una agencia?',
					'label_attr'    => array( 'class' => 'text-green h2' )
				) );
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
