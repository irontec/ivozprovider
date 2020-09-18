<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class => ['all' => true],
    Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle::class => ['all' => true],

    Symfony\Bundle\DebugBundle\DebugBundle::class => ['dev' => true, 'test' => true, 'tests_e2e' => true],
    Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle::class => ['test' => true, 'tests_e2e' => true],
    DocteurKlein\TestDoubleBundle::class => ['test' => true],

    Ivoz\CoreBundle\CoreBundle::class => ['all' => true],
    Ivoz\ProviderBundle\ProviderBundle::class => ['all' => true],
    IvozDevTools\CommandlogBundle\CommandlogBundle::class => ['all' => true],
    IvozDevTools\EntityGeneratorBundle\EntityGeneratorBundle::class => ['all' => true],
//    IvozDevTools\MigrationsBundle\MigrationsBundle::class => ['all' => true],
];
