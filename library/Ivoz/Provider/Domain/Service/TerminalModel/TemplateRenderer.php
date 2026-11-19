<?php

namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Core\Domain\DataTransferObjectInterface;

class TemplateRenderer
{
    const FORBIDDEN_FUNCTIONS = [
        'exec',       // Returns last line of commands output
        'passthru',   // Passes commands output directly to the browser
        'system',     // Passes commands output directly to the browser and returns last line
        'shell_exec', // Returns commands output
        'popen',      // Opens read or write pipe to process of a command
        'proc_open',  // Similar to popen() but greater degree of control
        'pcntl_exec', // Executes a program

        'require',
        'require_once',
        'include',
        'include_once',

        'phpinfo',
        'getenv',
        'putenv',

        'fopen',
        'file_get_contents',
        'file_put_contents',
    ];

    /**
     * @param array<string, DataTransferObjectInterface> $args
     */
    public function __construct(
        private string $templatePath,
        private array $args
    ) {
        if (!is_file($this->templatePath)) {
            throw new \Exception(
                'Template not found in path ' . $this->templatePath
            );
        }
    }

    public function execute(): string
    {
        $templateWrapper = str_replace(
            '[__TEMPLATE_BODY__]',
            (string) \file_get_contents($this->templatePath),
            $this->getTemplateWrapper()
        );

        $serializedArgs = base64_encode(
            serialize($this->args)
        );

        $tmpFilePath = $this->createTmpFile(
            $templateWrapper
        );

        $errorFilePath = $this->createTmpFile('');

        try {
            $content = $this->runTemplate(
                $tmpFilePath,
                $errorFilePath,
                $serializedArgs
            );
        } finally {
            unlink($tmpFilePath);
            unlink($errorFilePath);
        }

        return $content;
    }

    /**
     * Serialized args go through stdin: as a command line argument they
     * can exceed the kernel limit for a single argument (E2BIG).
     * Child stderr goes to a file so that it can't fill a pipe and block.
     */
    private function runTemplate(
        string $tmpFilePath,
        string $errorFilePath,
        string $serializedArgs
    ): string {
        $command = [
            'php',
            '-d',
            'disable_functions=' . implode(',', self::FORBIDDEN_FUNCTIONS),
            '-d',
            'display_errors=stderr',
            '-d',
            'log_errors=0',
            $tmpFilePath,
        ];

        $process = proc_open(
            $command,
            [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => ['file', $errorFilePath, 'w'],
            ],
            $pipes
        );

        if (!is_resource($process)) {
            throw new \RuntimeException(
                'Unable to evaluate template: unable to start php'
            );
        }

        fwrite($pipes[0], $serializedArgs);
        fclose($pipes[0]);

        $content = (string) stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $exitCode = proc_close($process);

        if ($exitCode !== 0 || $content === '') {
            $errors = trim(
                (string) file_get_contents($errorFilePath, false, null, 0, 2000)
            );

            throw new \RuntimeException(
                sprintf(
                    'Unable to evaluate template (exit code %d): %s',
                    $exitCode,
                    $errors
                )
            );
        }

        return $content;
    }

    private function getTemplateWrapper(): string
    {
        $templateWrapper = '<?php
            require \'/opt/irontec/ivozprovider/library/vendor/autoload.php\';
            // There is no SERVER_NAME in console commands, inject it
            $_SERVER["SERVER_NAME"] = "[__SERVER_NAME__]";

            function getenv() {
                return ""; // Some vendor require this function
            }

            class TemplateWrapper
            {
                public function __construct($input)
                {
                    $data = unserialize(base64_decode($input));
                    foreach ($data as $key => $val) {
                        $this->$key = $val;
                    }
                }

                public function run()
                {
                    error_reporting(error_reporting() & ~E_NOTICE);
                    ?>[__TEMPLATE_BODY__]<?php
                }
            }

            $wrapper = new TemplateWrapper(stream_get_contents(STDIN));
            $wrapper->run();
        ?>';

        $serverName = ($_SERVER['SERVER_NAME'] ?? 'unknown.server.name');
        return str_replace(
            '[__SERVER_NAME__]',
            (string) $serverName,
            $templateWrapper,
        );
    }

    private function createTmpFile(string $templateWrapper): string
    {
        $tmpFilePath = tempnam(
            '/tmp',
            'provision-template-'
        );
        if (!$tmpFilePath) {
            throw new \RuntimeException('Unable to create tmp file');
        }
        $handle = fopen($tmpFilePath, 'w');
        if (!$handle) {
            throw new \RuntimeException('Unable to open tmp file');
        }

        fwrite($handle, $templateWrapper);
        fclose($handle);

        return $tmpFilePath;
    }
}
