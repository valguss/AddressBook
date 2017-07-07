<?php
namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType {

	public function buildForm( FormBuilderInterface $builder, array $options ) {

		$builder->add('firstName')
			->add('lastName')
			->add('birthday', DateType::class, array(
				'years' => range(1900,date('Y'))
			));

	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Contact::class
		]);
	}

	public function getBlockPrefix()
	{
		return 'app_bundle_contact_form_type';
	}
}