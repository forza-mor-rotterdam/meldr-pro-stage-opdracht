<?php

// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
/**
* @Route("/", name="home")
*/
public function index(): Response
{
// Render de Twig-sjabloon voor de homepagina
return $this->render('security/home.html.twig');
}
}
