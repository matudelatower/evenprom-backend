<?php

namespace UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add(
				'username',
				TextType::class,
				array(
					'label'              => 'form.username',
					'translation_domain' => 'FOSUserBundle',
				)
			)
			->add(
				'email',
				EmailType::class,
				array(
					'label'              => 'form.email',
					'translation_domain' => 'FOSUserBundle',
				)
			)
			->add(
				'plain_password',
				PasswordType::class,
				array(
					'label'              => 'form.password',
					'translation_domain' => 'FOSUserBundle',
				)
			)
			->add(
				'enabled',
				CheckboxType::class,
				array(
					'label' => 'Activo',
					'value' => false,
				)
			);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class' => 'UsuariosBundle\Entity\Usuario'
		) );
	}

	/**
	 * @return string
	 */
	public function getBlockPrefix() {
		return 'usuariosbundle_usuario';
	}
}
