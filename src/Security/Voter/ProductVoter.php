<?php

namespace App\Security\Voter;

use App\Entity\Product;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;


class ProductVoter extends Voter
{
    public const EDIT = 'PRODUCT_EDIT';
    public const DELETE = 'PRODUCT_DELETE';
    public const CREATE = 'PRODUCT_CREATE';

    public function __construct(private Security $security)
    {
    }
    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::DELETE, self::CREATE])
        && ($subject instanceof Product || $subject === null);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        // Seuls les admins peuvent gérer les utilisateurs
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return false;
    }
}

