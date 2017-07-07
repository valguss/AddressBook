<?php
namespace AppBundle\Form;

use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressFormType extends AbstractType {

	public function buildForm( FormBuilderInterface $builder, array $options ) {

		$builder->add('firstLine')
			->add('secondLine');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Address::class
		]);
	}

	public function getBlockPrefix()
	{
		return 'app_bundle_address_form_type';
	}
}