<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Gruppo;
use App\Entity\Utenti;
use App\Services\NumGenerator;

class DefaultController extends AbstractController
{
	/**
	 * @Route("/", name="home")
	 */
	public function homepage()
	{
		return $this->render('base.html.twig');
	}

	/**
	 * @Route("/prova-twig/{name}")
	 */
	public function provaTwig($name = NULL)
	{
		return $this->render('prova-twig.html.twig', [
			'name' => $name
		]);
	}

	/**
	 * @Route("/crea-utenti")
	 */
	public function creaUtenti()
	{
		$gruppo = new Gruppo();
		$Utente1 = new Utenti();
		$Utente2 = new Utenti();
		$Utente3 = new Utenti();

        $gruppo->setNome("Nome gruppo");
        $gruppo->setUtenti(123);

       	$Utente1->setNome("Nome1");
		$Utente1->setCognome("Cognome1");
		$Utente1->setEmail("email1");
		$Utente1->setGruppo($gruppo);

		$Utente2->setNome("Nome2");
		$Utente2->setCognome("Cognome2");
		$Utente2->setEmail("email2");
		$Utente2->setGruppo($gruppo);

		$Utente3->setNome("Nome3");
		$Utente3->setCognome("Cognome3");
		$Utente3->setEmail("email3");
		$Utente3->setGruppo($gruppo);

        $em = $this->getDoctrine()->getManager();
        $em->persist($gruppo);
        $em->persist($Utente1);
        $em->persist($Utente2);
        $em->persist($Utente3);
        $em->flush();

        return $this->render('prova-twig.html.twig', [
            'name' => 'OK',
        ]);
	}

	/**
	 * @Route("/prova-doctrine")
	 */
	public function provaDoctrine()
	{
		$em = $this->getDoctrine()->getManager();

		$query = $em->createQuery('SELECT u FROM App\Entity\Utenti u');
		$utenti = $query->getResult();

		shuffle($utenti);
		
		return $this->render('utenti.html.twig', [
            'utenti' => $utenti,
        ]);
	}

	public function stampaOra()
	{
		return date("d/m/Y h:m:s");
	}

	/**
	 * @Route("/prova-symfony")
	 */
	public function provaSymfony(NumGenerator $numGenerator)
	{
		$rand = dump($numGenerator->genInteger());

		$data = $this->stampaOra();

		return $this->render('prova-symfony.html.twig', [
			'rand' => $rand,
			'data' => $data
		]);

		//return $this->render('base.html.twig');
	}

}