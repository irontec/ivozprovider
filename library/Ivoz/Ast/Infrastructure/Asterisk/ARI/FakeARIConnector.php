<?php

namespace Ivoz\Ast\Infrastructure\Asterisk\ARI;

use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

class FakeARIConnector extends ARIConnector
{
    /**
     * @return void
     */
    public function sendFaxfileRequest(FaxesInOutInterface $faxFile)
    {
    }
}
