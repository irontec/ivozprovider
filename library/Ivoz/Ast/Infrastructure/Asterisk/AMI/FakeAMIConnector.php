<?php

namespace Ivoz\Ast\Infrastructure\Asterisk\AMI;

class FakeAMIConnector extends AMIConnector
{
    public function mailboxRefresh(string $mailbox): void
    {
    }
}
