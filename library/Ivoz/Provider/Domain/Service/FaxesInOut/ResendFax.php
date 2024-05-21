<?php

namespace Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

class ResendFax
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public function execute(FaxesInOutInterface $fax): void
    {
        if ($fax->getType() !== FaxesInOut::TYPE_OUT) {
            throw new \DomainException(
                'Cannot resend fax of type In',
                400
            );
        }

        if ($fax->getStatus() !== FaxesInOut::STATUS_ERROR) {
            throw new \DomainException(
                'Cannot resend fax with no error status',
                400
            );
        }

        /** @var FaxesInOutDto $faxDto */
        $faxDto = $this->entityTools->entityToDto($fax);

        $faxDto->setStatus(FaxesInOut::STATUS_PENDING);

        $this
            ->entityTools
            ->persistDto($faxDto, $fax);
    }
}
