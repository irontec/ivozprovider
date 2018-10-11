<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\Mailer\Message;

interface MailerClientInterface
{
    /**
     * @param Message $message
     * @return void
     */
    public function send(Message $message);
}
