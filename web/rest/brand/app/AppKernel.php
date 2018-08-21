<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    protected $consoleContext;

    /**
     * @inheritdoc
     */
    public function __construct($environment, $debug, bool $consoleContext = false)
    {
        $this->consoleContext = $consoleContext;

        return parent::__construct(...func_get_args());
    }

    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Nelmio\CorsBundle\NelmioCorsBundle(),
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),
            new ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),

            /* CoreBundle */
            new CoreBundle\CoreBundle(),

            /* ApiBundle */
            new ApiBundle\ApiBundle()
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        if ($this->getEnvironment() === 'test') {
            $bundles[] = new \DocteurKlein\TestDoubleBundle();
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
        $loader->load(
            $this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml'
        );
    }
}
