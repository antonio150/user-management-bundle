<?php

namespace Navira\UserManagementBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RoleManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function assignRole(UserInterface $user, string $role): void
    {
        $roles = $user->getRoles();
        if (!in_array($role, $roles)) {
            $roles[] = $role;
            $user->setRoles($roles);
            $this->entityManager->flush();
        }
    }

    public function removeRole(UserInterface $user, string $role): void
    {
        $roles = array_filter($user->getRoles(), fn($r) => $r !== $role);
        $user->setRoles($roles);
        $this->entityManager->flush();
    }
}
