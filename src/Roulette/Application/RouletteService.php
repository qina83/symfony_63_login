<?php

namespace App\Roulette\Application;

use App\Common\Domain\Exception\OperazioneNonConsentitaException;
use App\Common\Domain\Permission\UserWithPermissions;
use App\Security\Domain\SecurityUser;
use Szopen\SimpleAccessControl\Application\UserAuthorizationService;
use Szopen\SimpleAccessControl\Domain\Action;

class RouletteService
{
    public function __construct(
        private UserAuthorizationService $userAuthorizationService
    )
    {
    }

    public function scommetti(UserWithPermissions $user): void
    {
        $this->checkPermission($user, new Action('roulette.partita.scommetti'));
    }

    public function pulisciTavolo(UserWithPermissions $user): void
    {
        $this->checkPermission($user, new Action('roulette.tavolo.chiudi'));
    }

    public function chiudiTavolo(UserWithPermissions $user): void
    {
        $this->checkPermission($user, new Action('roulette.tavolo.chiudi'));
    }

    private function checkPermission(UserWithPermissions $user, Action $action)
    {
        $this->userAuthorizationService->canUserPerformAction($user,$action);
    }
}
