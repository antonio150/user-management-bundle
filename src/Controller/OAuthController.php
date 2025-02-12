<?php

namespace Navira\UserManagementBundle\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class OAuthController extends AbstractController
{
    #[Route('/connect/{service}', name: 'connect_oauth')]
    public function connect(ClientRegistry $clientRegistry, string $service): Response
    {
        // Redirige vers le fournisseur OAuth (ex: Google, Facebook)
        return $clientRegistry->getClient($service)->redirect([], []);
    }

    #[Route('/connect/{service}/check', name: 'connect_oauth_check')]
    public function connectCheck(Request $request, UserInterface $user = null): Response
    {
        if (!$user) {
            return $this->redirectToRoute('login');
        }

        // Après connexion, redirige vers le dashboard
        return $this->redirectToRoute('user_management_index');
    }
}
