<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;

class TerminalFactory
{
    protected $terminalRepository;
    protected $terminalModelRepository;
    protected $entityTools;

    public function __construct(
        TerminalRepository $terminalRepository,
        TerminalModelRepository $terminalModelRepository,
        EntityTools $entityTools
    ) {
        $this->terminalRepository = $terminalRepository;
        $this->terminalModelRepository = $terminalModelRepository;
        $this->entityTools = $entityTools;
    }

    /**
     * @throws \Exception
     */
    public function fromMassProvisioningCsv(
        int $companyId,
        string $name,
        string $password,
        string $model,
        string $mac
    ): TerminalInterface {

        $terminalModelId = null;
        if ($model) {
            $terminalModel = $this->terminalModelRepository->findOneByName($model);

            if (!$terminalModel) {
                throw new \DomainException(
                    'terminal model not found',
                    404
                );
            }

            $terminalModelId = $terminalModel->getId();
        }

        $terminal = $this->terminalRepository->findOneByCompanyAndName(
            $companyId,
            $name
        );

        if (is_null($terminal) && $mac) {
            $terminal = $this->terminalRepository->findOneByMac(
                $mac
            );

            if ($terminal && $terminal->getCompany()->getId() !== $companyId) {
                throw new \DomainException(
                    'Mac already exists in another company\'s terminal'
                );
            }
        }

        if ($terminal) {
            return $terminal;
        }

        $terminalDto = new TerminalDto();
        $terminalDto
            ->setName($name)
            ->setPassword($password)
            ->setMac($mac)
            ->setTerminalModelId(
                $terminalModelId
            )
            ->setCompanyId($companyId);

        /** @var TerminalInterface $terminal */
        $terminal = $this
            ->entityTools
            ->dtoToEntity(
                $terminalDto
            );

        return $terminal;
    }
}
