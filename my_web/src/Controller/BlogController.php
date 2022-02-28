<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function ejercicio41(string $title, string $year, string $_locale, string $_format): Response
    {
        return new Response(
            '<html><body>'
            . '<div>Idioma: '.$_locale.'</div>'
            . '<div>Año: '.$year.'</div>'
            . '<div>Título: '.$title.'</div>'
            . '<div>Formato: '.$_format.'</div>'
            . '</body></html>'
        );
    }

    public function ejercicio51()
    {
        $date = new \DateTime('1987-01-31');

        return $this->render(
            'ejercicio51/51.html.twig', [ 'variablefecha' => $date ]
        );
    }
}