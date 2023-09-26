<?php

namespace Controller\Provider\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultTemplateAction
{
    public function __construct(
        private TerminalModelRepository $terminalModelRepository,
        private string $defaultTemplatePath,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $id = (int) $request->attributes->get('id');
        $type = (string) $request->query->get('type');
        if (!in_array($type, ['generic', 'specific'])) {
            throw new \InvalidArgumentException('Unknown type');
        }

        /** @var TerminalModelInterface | null $terminalModel */
        $terminalModel = $this->terminalModelRepository->find($id);
        if (!$terminalModel) {
            throw new NotFoundHttpException('Terminal model not found');
        }

        $iden = $terminalModel->getIden();
        $sourceFile = sprintf(
            $this->defaultTemplatePath . 'provisioning/%s/%s.cfg',
            $iden,
            $type
        );

        if (!file_exists($sourceFile)) {
            throw new \RuntimeException('file not found: ' . $sourceFile);
        }

        /** @var string $response */
        $response = \file_get_contents($sourceFile);

        return new Response(
            content: $response,
            headers: [
                'Content-Type' => 'text/plain',
            ]
        );
    }
}
