<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ThumbRubroType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	        ->add( 'imageFile',
		        VichImageType::class,
		        array(
			        'required'      => false,
			        'allow_delete'  => true, // not mandatory, default is true
			        'download_link' => true, // not mandatory, default is true
			        'label'         => 'Imagen Miniatura'
		        ) )

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ThumbRubro'
        ));
    }
}
