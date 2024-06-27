<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
$config->setParallelConfig(new PhpCsFixer\Runner\Parallel\ParallelConfig(4, 5));

return $config->setRules(
    [
        '@Symfony' => true,
        'blank_line_between_import_groups' => false,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
        'heredoc_to_nowdoc' => true,
        'method_chaining_indentation' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'nullable_type_declaration' => ['syntax' => 'union'],
        'ordered_class_elements' => true,
        'php_unit_test_class_requires_covers' => true,
        'phpdoc_types_order' => true,
        'return_assignment' => true,
        'simplified_null_return' => true,
        'string_implicit_backslashes' => true,
    ]
)
    ->setFinder($finder);
