<?php

namespace spec\Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto;
use Ivoz\Provider\Domain\Service\TerminalModel\TemplateRenderer;
use PhpSpec\ObjectBehavior;

class TemplateRendererSpec extends ObjectBehavior
{
    private string $templatePath;

    function let()
    {
        $this->templatePath = (string) tempnam(
            sys_get_temp_dir(),
            'template-renderer-spec-'
        );

        $this->beConstructedWith(
            $this->templatePath,
            []
        );
    }

    function letGo()
    {
        if (is_file($this->templatePath)) {
            unlink($this->templatePath);
        }
    }

    function it_renders_arguments_larger_than_a_command_line_argument()
    {
        file_put_contents(
            $this->templatePath,
            'length: <?php echo strlen($this->terminalModel->getGenericTemplate()); ?>'
        );

        $terminalModelDto = (new TerminalModelDto())
            ->setGenericTemplate(str_repeat('a', 200000));

        $this->beConstructedWith(
            $this->templatePath,
            ['terminalModel' => $terminalModelDto]
        );

        $this
            ->execute()
            ->shouldBe('length: 200000');
    }

    function it_reports_the_child_exit_code_and_errors_when_the_template_fails()
    {
        file_put_contents(
            $this->templatePath,
            'before <?php undefinedProvisionFunction(); ?> after'
        );

        $message = '';
        try {
            $this->getWrappedObject()->execute();
        } catch (\RuntimeException $e) {
            $message = $e->getMessage();
        }

        if (!str_contains($message, 'Unable to evaluate template (exit code 255)')) {
            throw new \Exception('Missing exit code in: ' . $message);
        }

        if (!str_contains($message, 'Call to undefined function undefinedProvisionFunction()')) {
            throw new \Exception('Missing child error in: ' . $message);
        }
    }

    function it_reports_template_syntax_errors_even_if_args_are_not_read()
    {
        file_put_contents(
            $this->templatePath,
            '<?php if ( ?>'
        );

        $terminalModelDto = (new TerminalModelDto())
            ->setGenericTemplate(str_repeat('a', 200000));

        $this->beConstructedWith(
            $this->templatePath,
            ['terminalModel' => $terminalModelDto]
        );

        $message = '';
        try {
            $this->getWrappedObject()->execute();
        } catch (\RuntimeException $e) {
            $message = $e->getMessage();
        }

        if (!str_contains($message, 'Unable to evaluate template (exit code 255)')) {
            throw new \Exception('Missing exit code in: ' . $message);
        }

        if (!str_contains($message, 'Parse error')) {
            throw new \Exception('Missing parse error in: ' . $message);
        }
    }
}
