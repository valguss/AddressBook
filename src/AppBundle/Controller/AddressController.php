<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Contact;
use AppBundle\Form\AddressFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends AbstractController
{
	/**
	 * @Route("/view/{id}/new", name="address_new")
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function newAction(Request $request)
	{
		$form = $this->createForm(ContactFormType::class);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$contact = $form->getData();

			$em = $this->getDoctrine()->getManager();
			$em->persist($contact);
			$em->flush();

			$this->addFlash('success', 'Contact created!');

			return $this->redirectToRoute('addressBook_list');
		}

		return $this->render('default/new.html.twig', [
			'contactForm' => $form->createView()
		]);
	}

	/**
	 * @Route("/view/{contact_id}/edit/{id}", name="address_edit")
	 * @param Request $request
	 * @param Address $address
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, Address $address)
	{
		$form = $this->createForm(AddressFormType::class, $address);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$address = $form->getData();

			$em = $this->getDoctrine()->getManager();
			$em->persist($address);
			$em->flush();

			$this->addFlash('success', 'Address edited!');

			return $this->redirectToRoute('addressBook_list');
		}

		return $this->render('address/edit.html.twig', [
			'addressForm' => $form->createView()
		]);
	}
}
