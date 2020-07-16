<?php

/**
 * This file is part of the Eightmarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EightMarq\CoreBundle\Entity;

interface BaseEntityInterface
{
    /**
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void;
}