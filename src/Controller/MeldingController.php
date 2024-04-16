<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MeldingController extends AbstractController
{
    #[Route('/meldingen')]
    public function index(Request $request): Response
    {
        return $this->render('melding/index.html.twig');
    }
}