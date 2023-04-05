<?php

namespace Services;

use Ivoz\Core\Domain\DataTransferObjectInterface;

class TemplateRenderer
{
    /**
     * @param array<string, DataTransferObjectInterface> $args
     */
    public function __construct(
        private string $templatePath,
        array $args
    ) {
        if (!is_file($this->templatePath)) {
            throw new \Exception(
                'Template not found in path ' . $this->templatePath
            );
        }

        foreach ($args as $key => $value) {
            $this->$key = $value;
        }
    }

    public function execute(): string
    {
        ob_start();
        include($this->templatePath);
        /** @var string $content */
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
