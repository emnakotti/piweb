<?php

namespace App\Twig;

use App\Repository\ReservationRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private ReservationRepository $reservationRepo;

    public function __construct(ReservationRepository $reservationRepo)
    {
        $this->reservationRepo = $reservationRepo;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_reservation_count', [$this, 'getReservationCount']),
        ];
    }

    public function getReservationCount(): int
    {
        try {
            return $this->reservationRepo->count([]) ?? 0;
        } catch (\Exception $e) {
            // En environnement dev, vous pourriez logger l'erreur
            return 0;
        }
    }
}
