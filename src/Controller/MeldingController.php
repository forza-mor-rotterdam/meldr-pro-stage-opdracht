<?php

namespace App\Controller;

use App\Entity\Melding;
use App\Form\MeldingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $melding->setMeldingId((int)uniqid());
        $melding->setUser($this->getUser()); // Assuming the logged-in user is creating the melding
        $melding->setDatumTijd(new \DateTime());

        $form = $this->createForm(MeldingType::class, $melding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $afbeeldingFile */
            $afbeeldingFile = $form->get('afbeelding')->getData();

            if ($afbeeldingFile) {
                // Generate a unique filename
                $nieuweBestandsnaam = uniqid().'.'.$afbeeldingFile->getClientOriginalExtension();

                // Move the file to the desired directory
                $afbeeldingFile->move(
                    $this->getParameter('afbeeldingen_directory'),
                    $nieuweBestandsnaam
                );

                // Update the entity with the URL of the image
                $melding->setAfbeeldingUrl($nieuweBestandsnaam);
            }

            $this->entityManager->persist($melding);
            $this->entityManager->flush();

            return $this->redirectToRoute('melding_bevestiging', ['id' => $melding->getMeldingId()]);
        }

        return $this->render('melding/toevoegen.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bevestiging/{id}', name: 'melding_bevestiging')]
    public function bevestiging($id): Response
    {
        $melding = $this->entityManager->getRepository(Melding::class)->findOneBy(['melding_id' => $id]);

        if (!$melding) {
            throw $this->createNotFoundException('Deze melding bestaat niet');
        }

        return $this->render('melding/bevestiging.html.twig', [
            'melding' => $melding,
        ]);
    }

    #[Route('/mijn-meldingen', name: 'mijn_meldingen')]
    public function mijnMeldingen(): Response
    {
        $currentUser = $this->getUser();
        $meldingen = $this->entityManager->getRepository(Melding::class)->findBy(['user' => $currentUser]);

        return $this->render('melding/mijn_meldingen.html.twig.html', [
            'meldingen' => $meldingen,
        ]);
    }

    #[Route('/meldingen-overzicht', name: 'meldingen_overzicht')]
    public function overzicht(Request $request): Response
    {
        $meldingen = $this->entityManager->getRepository(Melding::class)->findAll();

        return $this->render('melding/index.html.twig', [
            'meldingen' => $meldingen,
        ]);
    }

    #[Route('/details/{id}', name: 'melding_details')]
    public function details($id): Response
    {
        $melding = $this->entityManager->getRepository(Melding::class)->find($id);

        if (!$melding) {
            throw $this->createNotFoundException('Deze melding bestaat niet');
        }

        return $this->render('melding/meldingdetails.html.twig', [
            'melding' => $melding,
        ]);
    }

    #[Route('/afhandelen/{id}', name: 'melding_afhandelen')]
    public function afhandelen($id): Response
    {
        // Zoek de melding in de database op basis van de ID
        $melding = $this->entityManager->getRepository(Melding::class)->find($id);

        // Controleer of de melding bestaat
        if (!$melding) {
            // Gooi een 404 Not Found uitzondering als de melding niet bestaat
            throw $this->createNotFoundException('Deze melding bestaat niet');
        }

        // Markeer de melding als afgehandeld door de afgehandeld-vlag op true in te stellen
        $melding->setAfgehandeld(true);

        // Sla de wijzigingen op in de database
        $this->entityManager->flush();

        // Nadat de melding is afgehandeld, leid de gebruiker om naar de detailspagina van de melding
        return $this->redirectToRoute('melding_details', ['id' => $melding->getMeldingId()]);
    }
}
