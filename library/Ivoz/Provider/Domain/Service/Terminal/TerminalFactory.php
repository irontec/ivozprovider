<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Domain\Service\EntityTools;
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
     * @throws \DomainException
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

        $macOwner = $mac
            ? $this->terminalRepository->findOneByMac($mac)
            : null;

        $isOtherCompanyTerminal = $macOwner
            && $macOwner->getCompany()->getId() !== $companyId;
        if ($isOtherCompanyTerminal) {
            throw new \DomainException(
                'Mac already exists in another company\'s terminal'
            );
        }

        $isOtherTerminalMac = $terminal
            && $macOwner
            && $macOwner->getId() !== $terminal->getId();
        if ($isOtherTerminalMac) {
            throw new \DomainException(
                sprintf(
                    'MAC %s already belongs to terminal %s',
                    $mac,
                    $macOwner->getName()
                )
            );
        }

        $terminal = $terminal ?? $macOwner;

        /** @var TerminalDto $terminalDto */
        $terminalDto = $terminal instanceof TerminalInterface
            ? $this->entityTools->entityToDto($terminal)
            : new TerminalDto();

        if (empty($password)) {
            /** @var string $password */
            $password = $terminalDto->getPassword() !== ''
                ? $terminalDto->getPassword()
                : Terminal::randomPassword();
        }

        $terminalDto
            ->setName($name)
            ->setPassword($password)
            ->setCompanyId($companyId);

        if ($mac) {
            $terminalDto->setMac($mac);
        }

        if ($terminalModelId) {
            $terminalDto->setTerminalModelId($terminalModelId);
        }

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
