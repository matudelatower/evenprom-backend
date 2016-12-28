<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PromocionCalendarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion')
//            ->add('disponibleDesde',
//	            DateType::class,
//	            array(
//		            'widget' => 'single_text',
//		            'format' => 'dd-MM-yyyy',
//		            'attr'   => array(
//			            'class'       => 'datepicker',
//			            'placeholder' => "Fecha de fin de la oferta ",
//		            ),
//	            ) )
//            ->add('disponibleHasta',
//	            DateType::class,
//	            array(
//		            'widget' => 'single_text',
//		            'format' => 'dd-MM-yyyy',
//		            'attr'   => array(
//			            'class'       => 'datepicker',
//			            'placeholder' => "Fecha de fin de la oferta ",
//		            ),
//	            ) )
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
            ->add('imageFile',
	            VichImageType::class,
	            array(
		            'label'         => 'image.publicacion',
		            'required'      => false,
		            'allow_delete'  => true, // not mandatory, default is true
		            'download_link' => true, // not mandatory, default is true
	            ) )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PromocionCalendario'
        ));
    }
}
