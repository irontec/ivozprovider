<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),

            /* Core */
            new Ivoz\CoreBundle\CoreBundle(),

            /* Provider */
            new Ivoz\ProviderBundle\ProviderBundle(),

            /* CommandlogBundle */
            new IvozDevTools\CommandlogBundle\CommandlogBundle(),

            /* EntityGeneratorBundle */
            new IvozDevTools\EntityGeneratorBundle\EntityGeneratorBundle(),

            /* MigrationsBundle */
            new IvozDevTools\MigrationsBundle\MigrationsBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test', 'test_e2e'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();

            if ('dev' !== $this->getEnvironment()) {
                $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            }

            if ('test' === $this->getEnvironment()) {
                $bundles[] = new \DocteurKlein\TestDoubleBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/../config/config_'.$this->getEnvironment().'.yml');
    }
}
