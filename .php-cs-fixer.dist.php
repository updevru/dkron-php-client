<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
;

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@Symfony' => true,
    '@Symfony:risky' => true,
    '@PHP80Migration:risky' => true,
    '@PHP81Migration' => true,
    'strict_param' => true,
    'array_syntax' => ['syntax' => 'short'],
    'ordered_imports' => true,
])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;