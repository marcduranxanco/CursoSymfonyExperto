<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoutingController extends AbstractController
{
    public function secreto(): Response
    { 
        return new Response('<h1>Url Secreta</h1>');
    }
}