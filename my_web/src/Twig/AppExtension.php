<?php

namespace App\Twig;

use Twig\TwigFilter;

class AppExtension extends \Twig\Extension\AbstractExtension
{

    /**
     * Declaración de los filtros que hay en este archivo
     */
    public function getFilters()
    {
        return [
            new TwigFilter('tt', [$this, 'ttFilter'])
        ];
    }

    /**
     * Función que transforma el tiempo transcurrido en un
     * texto amigable para el usuario
     *
     * @param DateTime $date
     * @return string
     */
    public function ttFilter(\DateTime $date): string
    {
        $interval = date_diff($date, new \DateTime());
        dump($date);
        dump($interval);
        dump($interval->i);

        if ($interval->i >= 1 && $interval->i < 60) {
            return 'Hace '.$interval->i.' minutos';
        }

        if ($interval->h >= 1 && $interval->h < 24) {
            return 'Hace '.$interval->h.' horas';
        }

        if ($interval->d >= 1 && $interval->d < 30) {
            return 'Hace '.$interval->d.' dias';
        }

        if ($interval->m >= 1 && $interval->m < 12) {
            return 'Hace '.$interval->m.' meses';
        }

        if ($interval->y >= 1) {
            return 'Hace '.$interval->y.' años';
        }

        if ($interval->s < 60) {
            return 'Ahora';
        }
    }
}