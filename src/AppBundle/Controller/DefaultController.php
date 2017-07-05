<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="addressbook_list")
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
}
