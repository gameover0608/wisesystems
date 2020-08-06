<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {

    	$contact = new Contact();
        // ...

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {

	        // $form->getData() holds the submitted values
	        // but, the original `$task` variable has also been updated
	        $task = $form->getData();

	        $entityManager = $this->getDoctrine()->getManager();

	        // tell Doctrine you want to (eventually) save the Product (no queries yet)
	        $entityManager->persist($task);

	        // actually executes the queries (i.e. the INSERT query)
	        $entityManager->flush();

	        return $this->redirectToRoute('thanks');

	    }
            

        return $this->render('contact/index.html.twig', [
            'form' =>  $form->createView(),
        ]);
    }

    public function thanks()
    {

    	 return $this->render('contact/thanks.html.twig', []);

    }

}
