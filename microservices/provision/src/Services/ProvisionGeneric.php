<?php

namespace Services;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;

class ProvisionGeneric
{
    public function __construct(
        private string $storagePath,
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        TerminalModelInterface $terminalModel
    ): string {

        $route =
            $this->storagePath
            . DIRECTORY_SEPARATOR
            . "Provision_template"
            . DIRECTORY_SEPARATOR
            . (int) $terminalModel->getId()
            . DIRECTORY_SEPARATOR;

        $path = $route . 'generic.phtml';

        $terminalModelDto = $this->entityTools->entityToDto($terminalModel);

        $renderer = new TemplateRenderer(
            $path,
            [ 'terminalModel' => $terminalModelDto]
        );

        return $renderer->execute();
    }
}
