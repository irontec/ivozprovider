<?php

namespace Behat\Context;

use Behat\Behat\Context\Context;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var TerminalModelRepository
     */
    private $terminalModelRepository;

    /**
     * @var string
     */
    private $storagePath;

    public function __construct(
        KernelInterface $kernel
    ) {
        $this->fs = new Filesystem();
        $container = $kernel->getContainer();

        // @phpstan-ignore-next-line
        $this->storagePath = (string) $container->getParameter('storagePath');

        // @phpstan-ignore-next-line
        $this->terminalModelRepository = $container->get(
            TerminalModelRepository::class
        );
    }

    /**
     * @BeforeScenario
     */
    public function prepareTemplates(): void
    {
        /** @var TerminalModelInterface[] $terminalModels */
        $terminalModels = $this->terminalModelRepository->findAll();
        foreach ($terminalModels as $terminalModel) {
            $path =
                $this->storagePath
                . DIRECTORY_SEPARATOR
                . "Provision_template"
                . DIRECTORY_SEPARATOR
                . (int) $terminalModel->getId()
                . DIRECTORY_SEPARATOR
                . 'generic.phtml';

            $this->fs->dumpFile(
                $path,
                (string) $terminalModel->getGenericTemplate()
            );
        }
    }
}
