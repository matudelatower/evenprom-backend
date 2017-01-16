<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaUsuarioType extends AbstractType {
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
					'attr'               => array(
						'pattern'   => '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$',
						"oninvalid" => "setCustomValidity('Nombre de usuario no puede contener espacios')",
						"onchange"  => "try{setCustomValidity('')}catch(e){}"
					)
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
				RepeatedType::class,
				array(
					'type'            => PasswordType::class,
					'options'         => array( 'translation_domain' => 'FOSUserBundle' ),
					'first_options'   => array( 'label' => 'form.password' ),
					'second_options'  => array( 'label' => 'form.password_confirmation' ),
					'invalid_message' => 'fos_user.password.mismatch',
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
		return 'usuariosbundle_empresa_usuario';
	}
}
