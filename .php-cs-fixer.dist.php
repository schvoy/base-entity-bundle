<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

return new Config()
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRiskyAllowed(false)
    ->setRules([
        '@autoPHPMigration' => true,
        '@PER-CS' => true,
        '@PhpCsFixer' => true,
        '@Symfony' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
        'nullable_type_declaration' => ['syntax' => 'union'],
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
    ])
    // 💡 by default, Fixer looks for `*.php` files excluding `./vendor/` - here, you can groom this config
    ->setFinder(
        (new Finder())
            // 💡 root folder to check
            ->in(__DIR__)
    // 💡 additional files, eg bin entry file
    // ->append([__DIR__.'/bin-entry-file'])
    // 💡 folders to exclude, if any
    // ->exclude([/* ... */])
    // 💡 path patterns to exclude, if any
    // ->notPath([/* ... */])
    // 💡 extra configs
    // ->ignoreDotFiles(false) // true by default in v3, false in v4 or future mode
    // ->ignoreVCSIgnored(true) // true by default
    )
    ;
