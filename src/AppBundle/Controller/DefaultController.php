<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
	/**
	 * @Route("/", name="addressBook_list")
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$contacts = $em->getRepository('AppBundle:Contact')
	                   ->findAll();

        return $this->render('default/index.html.twig', [
        	'contacts' => $contacts
        ]);
    }

	/**
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/view/{id}", name="addressBook_view")
	 */
    public function viewAction(Request $request)
    {
	    $em = $this->getDoctrine()->getManager();

	    $contact = $em->getRepository('AppBundle:Contact')
	                   ->find($request->get('id'));

    	return $this->render('default/view.html.twig', [
    		'contact' => $contact
	    ]);
    }

	/**
	 * @Route("/new", name="addressBook_new")
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
	 * @Route("/edit/{id}", name="addressBook_edit")
	 * @param Request $request
	 * @param Contact $contact
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, Contact $contact)
	{
		$form = $this->createForm(ContactFormType::class, $contact);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$contact = $form->getData();

			$em = $this->getDoctrine()->getManager();
			$em->persist($contact);
			$em->flush();

			$this->addFlash('success', 'Contact edited!');

			return $this->redirectToRoute('addressBook_list');
		}

		return $this->render('default/edit.html.twig', [
			'contactForm' => $form->createView()
		]);
	}
}
