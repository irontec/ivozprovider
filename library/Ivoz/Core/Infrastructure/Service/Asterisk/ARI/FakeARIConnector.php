<?php

namespace Ivoz\Core\Infrastructure\Service\Asterisk\ARI;

use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

class FakeARIConnector extends ARIConnector
{
    public function sendFaxfileRequest(FaxesInOutInterface $faxFile)
    {
    }
}
