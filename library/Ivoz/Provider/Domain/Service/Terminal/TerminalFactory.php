<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;

class TerminalFactory
{
    public function __construct(
        private TerminalRepository $terminalRepository,
        private TerminalModelRepository $terminalModelRepository,
        private EntityTools $entityTools
    ) {
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
            $terminalModel = $this->terminalModelRepository->findOneByIden($model);

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

        /** @var TerminalDto $terminalDto */
        $terminalDto = $terminal instanceof TerminalInterface
            ? $this->entityTools->entityToDto($terminal)
            : new TerminalDto();

        if (empty($password)) {
            $password = $terminalDto->getPassword() !== ''
                ? $terminalDto->getPassword()
                : Terminal::randomPassword();
        }

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
                $terminalDto,
                $terminal
            );

        return $terminal;
    }
}
