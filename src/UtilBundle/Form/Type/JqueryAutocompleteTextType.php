<?php

namespace UtilBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of JqueryAutocompleteTextType
 *
 * @author sergio
 */
class JqueryAutocompleteTextType extends AbstractType {

    private $elements;
    public function __construct(&$elements=null) {
        $this->elements=$elements;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {

    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
        $id = $form->getData();
        $suggest="";
        if (!is_null($id)){
            if (count($this->elements)){
                $suggest = $this->elements->first();
                $this->elements->removeElement($suggest);
            }
            
        }

        $view->vars = array_replace($view->vars, array(
            'suggest_value' => $suggest,
            'route_name' => $options['route_name'],
            'extraParams' => $options['extraParams']
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'route_name' => 'ajax_default',
            'extraParams' => null
        ));
    }

    public function getParent() {
        return 'text';
    }

    public function getName() {
        return 'jqueryautocompletetext';
    }

}
