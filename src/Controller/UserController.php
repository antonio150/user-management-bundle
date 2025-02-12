<?php

namespace App\UserManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'user_management_index')]
    public function index(): Response
    {
        return new Response('<h1>User Management Bundle</h1>');
    }

    #[Route('/edit/{id}', name: 'user_edit')]
    public function edit(User $user, Request $request, RoleManager $roleManager): Response
    {
        if ($request->isMethod('POST')) {
            $role = $request->request->get('role');
            if ($role) {
                $roleManager->assignRole($user, $role);
            }
            return $this->redirectToRoute('user_management_index');
        }

        return $this->render('@UserManagement/user/edit.html.twig', compact('user'));
    }
}


