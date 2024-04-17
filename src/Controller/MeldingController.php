<?php

namespace App\Controller;

use App\Entity\Melding;
use App\Form\MeldingType;
use App\Repository\MeldingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MeldingController extends AbstractController
{
    #[Route('/melding/toevoegen', name: 'melding_toevoegen')]
    public function toevoegen(Request $request, EntityManagerInterface $entityManager): Response
    {
        $melding = new Melding();
        $melding->setMeldingId((int)uniqid()); // Unieke melding ID genereren
        $melding->setUserId($this->getUser()->getId()); // Gebruikers-ID instellen
        $melding->setDatumTijd(new \DateTime()); // Huidige datum en tijd instellen

        $form = $this->createForm(MeldingType::class, $melding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gebruik de EntityManager om de melding op te slaan
            $entityManager->persist($melding);
            $entityManager->flush();

            $this->addFlash('success', 'Melding toegevoegd!');

            return $this->redirectToRoute('melding_toevoegen'); // Herladen van de pagina na toevoegen van melding
        }

        return $this->render('melding/toevoegen.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/meldingen', name: 'meldingen_overzicht')]
    public function overzicht(Request $request, MeldingRepository $meldingRepository): Response
    {
        $type_Melding = $request->query->get('type_melding');


        if ($type_Melding) {
            $meldingen = $meldingRepository->findByTypeMelding($type_Melding);
        } else {
            $meldingen = $meldingRepository->findAll();
        }

        return $this->render('melding/index.html.twig', [
            'meldingen' => $meldingen,
        ]);
    }
}
