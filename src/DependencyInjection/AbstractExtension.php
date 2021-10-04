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

namespace EightMarq\CoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

abstract class AbstractExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @var array
     */
    protected array $targetEntities = [];

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container): void
    {
        $configs = $container->getExtensionConfig('doctrine');

        $config = reset($configs);

        $config['orm']['resolve_target_entities'] = array_merge(
            $config['orm']['resolve_target_entities'] ?? [],
            $this->targetEntities
        );

        $container->prependExtensionConfig('doctrine', $config);
    }
}