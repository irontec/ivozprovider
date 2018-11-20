<?php

namespace spec\Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Service\TerminalModel\PersistTemplates;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;

class PersistTemplatesSpec extends ObjectBehavior
{
    protected $localStoragePath;
    protected $templateStoragePath;
    protected $fs;

    function let(
        Filesystem $fs
    ) {
        $this->localStoragePath = '/tmp/storagePath';

        $this->templateStoragePath =
            $this->localStoragePath
            . '/Provision_template/1';

        $this->fs = $fs;

        $this->beConstructedWith(
            $this->localStoragePath,
            $fs
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PersistTemplates::class);
    }

    function it_returns_if_no_template_has_changed(
        TerminalModelInterface $entity
    ) {
        $this->fs
            ->exists(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    private function prepareNoChangesExampleBase(TerminalModelInterface $entity)
    {
        $entity
            ->hasChanged('genericTemplate')
            ->willReturn(false);

        $entity
            ->hasChanged('specificTemplate')
            ->willReturn(false);

        $entity
            ->getGenericTemplate()
            ->willReturn('GenericTemplateContent');

        $entity
            ->getSpecificTemplate()
            ->willReturn('SpecificTemplateContent');

        $entity
            ->getId()
            ->willReturn(1);
    }

    private function prepareChangedTemplateExample($entity, $template = 'generic')
    {
        $entity
            ->hasChanged($template . 'Template')
            ->willReturn(true);

        $this
            ->fs
            ->exists($this->templateStoragePath)
            ->willReturn(true);

        $this
            ->fs
            ->exists(
                $this->templateStoragePath . '/' . $template . '.phtml'
            )
            ->willReturn(false);

        $this
            ->fs
            ->dumpFile(Argument::any(), Argument::any())
            ->shouldBeCalled();
    }

    function it_checks_whether_storage_exists(
        TerminalModelInterface $entity
    ) {
        $this->prepareNoChangesExampleBase($entity);
        $this->prepareChangedTemplateExample($entity);

        $this
            ->fs
            ->exists($this->templateStoragePath)
            ->willReturn(true);


        $this->execute($entity);
    }

    function it_creates_storage_folder_when_it_doesnt_exist(
        TerminalModelInterface $entity
    ) {
        $this->prepareNoChangesExampleBase($entity);
        $this->prepareChangedTemplateExample($entity);

        $this
            ->fs
            ->exists($this->templateStoragePath)
            ->willReturn(false);

        $this
            ->fs
            ->mkdir($this->templateStoragePath, 0777)
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function it_persist_generic_template_to_disk_when_changed(
        TerminalModelInterface $entity
    ) {
        $this->prepareNoChangesExampleBase($entity);
        $this->prepareChangedTemplateExample($entity);

        $this
            ->fs
            ->dumpFile(
                $this->templateStoragePath . '/generic.phtml',
                'GenericTemplateContent'
            )
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function it_backups_old_generic_template(
        TerminalModelInterface $entity
    ) {
        $this->prepareNoChangesExampleBase($entity);
        $this->prepareChangedTemplateExample($entity);

        $filePath = $this->templateStoragePath . '/generic.phtml';
        $this
            ->fs
            ->exists($filePath)
            ->willReturn(true);

        $this
            ->fs
            ->rename(
                $filePath,
                $filePath . '.back'
            )
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function it_persist_specific_template_to_disk_when_changed(
        TerminalModelInterface $entity
    ) {
        $this->prepareNoChangesExampleBase($entity);
        $this->prepareChangedTemplateExample($entity, 'specific');

        $this
            ->fs
            ->dumpFile(
                $this->templateStoragePath . '/specific.phtml',
                'SpecificTemplateContent'
            )
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function it_backups_old_specific_template(
        TerminalModelInterface $entity
    ) {
        $this->prepareNoChangesExampleBase($entity);
        $this->prepareChangedTemplateExample($entity, 'specific');

        $filePath = $this->templateStoragePath . '/specific.phtml';
        $this
            ->fs
            ->exists($filePath)
            ->willReturn(true);

        $this
            ->fs
            ->rename(
                $filePath,
                $filePath . '.back'
            )
            ->shouldBeCalled();

        $this->execute($entity);
    }
}
