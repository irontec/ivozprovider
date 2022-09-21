<?php

namespace Services;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** @psalm-suppress PropertyNotSetInConstructor */
class Provision extends AbstractController
{
    private string $storagePath;

    public function __construct(
        private TerminalModelRepository $terminalModelRepository,
    ) {
        $this->storagePath = (string) $_ENV['STORAGE_PATH'];
    }

    public function execute(string $genericUrlPattern): bool|string
    {
        $terminalModel = $this
            ->terminalModelRepository
            ->findOneByGenericUrlPattern($genericUrlPattern);

        if ($terminalModel) {
            $args = [
                'terminalModel' => $terminalModel
            ];

            return $this->renderTemplate('generic', $args);
        }

        return '';
    }


    /**
     * @param string $template
     * @param array<string, mixed> $args
     * @return false|string
     */
    private function renderTemplate(string $template, array $args)
    {
        extract($args);

        if (!isset($terminalModel) || !($terminalModel instanceof TerminalModelInterface)) {
            throw  new \DomainException('Terminal Model is required');
        }

        $route =
            $this->storagePath
            . DIRECTORY_SEPARATOR
            . "Provision_template"
            . DIRECTORY_SEPARATOR
            . (int) $terminalModel->getId()
            . DIRECTORY_SEPARATOR;

        $path = $route . (string) $template . '.phtml';
        $content = '';

        if (file_exists($path)) {
            ob_start();
            include($path);
            $content = ob_get_contents();
            ob_end_clean();
        }

        return $content;
    }
}
