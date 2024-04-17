<?php

namespace App\Controller;

use App\Entity\Melding;
use App\Form\MeldingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/melding')]
class MeldingController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/toevoegen', name: 'melding_toevoegen')]
    public function toevoegen(Request $request): Response
    {
        $melding = new Melding();
        $melding->setMeldingId((int)uniqid()); // Unieke melding ID genereren
        $melding->setUserId($this->getUser()->getId()); // Gebruikers-ID instellen
        $melding->setDatumTijd(new \DateTime()); // Huidige datum en tijd instellen

        $form = $this->createForm(MeldingType::class, $melding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gebruik de EntityManager om de melding op te slaan
            $this->entityManager->persist($melding);
            $this->entityManager->flush();

            // Redirect naar de bevestigingspagina
            return $this->redirectToRoute('melding_bevestiging', ['id' => $melding->getMeldingId()]);
        }

        return $this->render('melding/toevoegen.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('melding/index.html.twig', name: 'meldingen_overzicht')]
    public function overzicht(Request $request): Response
    {
        $currentUser = $this->getUser();

        // Haal de geselecteerde categorie op uit de queryparameters van het verzoek
        $categorie = $request->query->get('type_melding');

        // Haal alle meldingen op of filter op de geselecteerde categorie
        if ($categorie) {
            $meldingen = $this->entityManager->getRepository(Melding::class)->findBy(['type_melding' => $categorie]);
        } else {
            $meldingen = $this->entityManager->getRepository(Melding::class)->findAll();
        }

        return $this->render('melding/index.html.twig', [
            'meldingen' => $meldingen,
            'currentUser' => $currentUser,
        ]);
    }

    #[Route('melding/mijn_meldingen.html.twig.html', name: 'mijn_meldingen')]
    public function mijnMeldingen(): Response
    {
        $currentUser = $this->getUser();
        $meldingen = $this->entityManager->getRepository(Melding::class)->findBy(['user_id' => $currentUser->getId()]);

        return $this->render('melding/mijn_meldingen.html.twig.html', [
            'meldingen' => $meldingen,
        ]);
    }

    #[Route('/bevestiging/{id}', name: 'melding_bevestiging')]
    public function bevestiging($id): Response
    {
        // Haal de melding op basis van melding_id
        $melding = $this->entityManager->getRepository(Melding::class)->findOneBy(['melding_id' => $id]);

        if (!$melding) {
            throw $this->createNotFoundException('Deze melding bestaat niet');
        }

        return $this->render('melding/bevestiging.html.twig', [
            'melding' => $melding,
        ]);
    }
}
