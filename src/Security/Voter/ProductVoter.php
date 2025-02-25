<?php

namespace App\Security\Voter;

use App\Entity\Product;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ProductVoter extends Voter
{
    public const EDIT = 'PRODUCT_EDIT';
    public const DELETE = 'PRODUCT_DELETE';
    public const CREATE = 'PRODUCT_CREATE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::DELETE, self::CREATE]) && $subject instanceof Product;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        
        if (!$user instanceof UserInterface) {
            return false;
        }

        return in_array('ROLE_ADMIN', $user->getRoles());
    }
}

