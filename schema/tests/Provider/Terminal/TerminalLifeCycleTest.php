<?php

namespace Tests\Provider\Terminal;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentify;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMember;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class TerminalLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return TerminalDto
     */
    protected function getTerminalDto()
    {
        $terminalDto = new TerminalDto();
        $terminalDto
            ->setName('terminalTest')
            ->setDirectMediaMethod('invite')
            ->setPassword('AUfVkn498_')
            ->setMac('')
            ->setCompanyId(1)
            ->setDomainId(1)
            ->setTerminalModelId(1);

        return $terminalDto;
    }

    protected function addTerminal()
    {
        $dto = $this->getTerminalDto();
        return $this
            ->entityTools
            ->persistDto($dto, null, true);
    }

    protected function updateTerminal()
    {
        $terminalRepository = $this->em
            ->getRepository(Terminal::class);

        $terminal = $terminalRepository->find(1);

        /** @var TerminalDto $terminalDto */
        $terminalDto = $this->entityTools->entityToDto($terminal);

        $terminalDto
            ->setName('UpdatedName');

        return $this
            ->entityTools
            ->persistDto($terminalDto, $terminal, true);
    }

    protected function removeTerminal()
    {
        $terminalRepository = $this->em
            ->getRepository(Terminal::class);

        $terminal = $terminalRepository->find(1);

        return $this
            ->entityTools
            ->remove($terminal);
    }

    /**
     * @test
     */
    public function it_persists_routing_tags()
    {
        $terminalRepository = $this->em
            ->getRepository(Terminal::class);

        $fixtureTerminal = $terminalRepository->findAll();

        $this->addTerminal();

        $terminals = $terminalRepository->findAll();
        $this->assertCount(
            count($fixtureTerminal) + 1,
            $terminals
        );

        /////////////////////////////////
        ///
        /////////////////////////////////

        $this->it_triggers_lifecycle_services();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            Terminal::class,
            PsEndpoint::class,
            PsIdentify::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateTerminal();
        $this->assetChangedEntities([
            Terminal::class,
            PsEndpoint::class,
            QueueMember::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_removes_lifecycle_services()
    {
        $this->removeTerminal();
        $this->assetChangedEntities([
            Terminal::class,
        ]);
    }
}
