<?php


namespace App\Security\Infrastructure\Controller;

use App\Common\Domain\Role\RoleFactory;
use App\Security\Application\Login;
use App\Security\Application\Registra;
use App\Security\Domain\Password;
use App\Security\Domain\Username;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/security')]
class SecurityController extends AbstractController
{
    #[Route('/registrati')]
    public function registrati(
        Registra $registra,
        Request $request,
        RoleFactory $roleFactory
    ): Response {
        $content = json_decode($request->getContent(), true);

        $username = $content['username'];
        $password = $content['password'];
        $role = $content['ruolo'];

        $registra->registrati(
            new Username($username),
            new Password($password),
            $roleFactory->createRole($role)
        );
        return new Response('registrato');
    }

    #[Route('/login')]
    public function login(
        Login $login,
        Request $request
    ): Response {
        $content = json_decode($request->getContent(), true);

        $username = $content['username'];
        $password = $content['password'];

        try {
           $jwt = $login->login(
               new Username($username),
               new Password($password),
           );

            return new JsonResponse($jwt, 400);
        } catch (\DomainException $exception) {
            return new Response($exception->getMessage(), 400);
        }
    }
}
