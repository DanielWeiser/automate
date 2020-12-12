<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $user = $this->security->getUser();

        if ($user) {
            if (in_array("ROLE_ADMIN", $user->getRoles(), true)) {
                return new RedirectResponse('/admin');
            }

            return new RedirectResponse('/');
        }
    }
}