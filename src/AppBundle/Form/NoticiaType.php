<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class NoticiaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('resumen')
            ->add( 'cuerpo',
                CKEditorType::class,
                array(
                    'config' => array(//'uiColor' => '#ffffff',
                    ),
                ) )
            ->add('visibleDesde',
                DateType::class,
                array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr'   => array(
                        'class' => 'datepicker',
                    ),
                ) )
            ->add('visibleHasta',
                DateType::class,
                array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr'   => array(
                        'class' => 'datepicker',
                    ),
                ) )
            ->add('orden')
            ->add('activo')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Noticia'
        ));
    }
}
