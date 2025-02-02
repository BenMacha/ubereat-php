<?php

$header = <<<'EOF'
    PHP version 7.4 - 8.4 .
    LICENSE: This source file is subject to version 3.01 of the PHP license
    that is available through the world-wide-web at the following URI:
    https://www.php.net/license/3_01.txt.

    POS developed by Ben Macha.

    @category   UberEat SDK

    @author     Ali BEN MECHA       <contact@benmacha.tn>
     
    @copyright  Ⓒ 2025 benmacha.tn

    @see       https://www.benmacha.tn

    EOF;

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'not_operator_with_successor_space' => true,
        'trailing_comma_in_multiline' => true,
        'phpdoc_scalar' => true,
        'header_comment' => ['header' => $header, 'comment_type' => 'PHPDoc'],
        'unary_operator_spaces' => true,
        'binary_operator_spaces' => true,
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
        ],
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_var_without_name' => true,
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'one',
            ],
        ],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
            'keep_multiple_spaces_after_comma' => true,
        ],
        'single_trait_insert_per_statement' => true,
    ])
    ->setFinder($finder);