<?php

namespace App\Roulette\Infrastructure\Controller;

use App\Common\Infrastructure\Controller\BaseAbstractController;
use App\Roulette\Application\RouletteService;
use App\Security\Domain\SecurityUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Szopen\SimpleAccessControl\Application\UserAuthorizationService;
use Szopen\SimpleAccessControl\Domain\Action;
use Szopen\SimpleAccessControl\Domain\Checker\AffirmativePermissionCheckerStrategy;

#[Route('/roulette')]
class RouletteController extends BaseAbstractController
{
    #[Route('/scommetti')]
    public function number(
        RouletteService $rouletteService
    ): Response
    {
        $rouletteService->scommetti(
            $this->getUserWithPermission()
        );
        return new Response('Operazione conclusa');
    }

    #[Route('/chiudi_tavolo')]
    public function chiudiTavolo(
        RouletteService $rouletteService
    ): Response
    {
        $rouletteService->chiudiTavolo(
            $this->getUserWithPermission()
        );
        return new Response('Operazione conclusa');
    }

    #[Route('/pulisci_tavolo')]
    public function pulisciTavolo(
        RouletteService $rouletteService
    ): Response
    {
        $rouletteService->pulisciTavolo(
            $this->getUserWithPermission()
        );
        return new Response('Operazione conclusa');
    }
}
