<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Fixtures\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Override;
use Schvoy\BaseEntityBundle\Entity\IdBasedEntity;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table]
class User extends IdBasedEntity implements UserInterface
{
    #[ORM\Column(type: Types::STRING, length: 180, unique: true)]
    protected string $email;

    #[ORM\Column(type: Types::JSON)]
    protected array $roles = [];

    #[ORM\Column(type: Types::STRING)]
    protected string $password;

    #[Override]
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    #[Override]
    public function eraseCredentials(): void
    {
    }

    #[Override]
    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
