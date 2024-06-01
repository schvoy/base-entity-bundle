<?php

/**
 * This file is part of the EightMarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EightMarq\CoreBundle\Entity\Interfaces;

use Symfony\Component\Uid\Ulid;

interface UlidBasedEntityInterface
{
    public function getId(): Ulid|null;

    public function setId(Ulid|null $id): void;
}
