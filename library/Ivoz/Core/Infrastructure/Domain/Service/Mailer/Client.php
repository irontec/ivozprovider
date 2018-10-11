<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Mailer;

use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\MailerClientInterface;

class Client implements MailerClientInterface
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * Sender constructor.
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Message $message
     * @return void
     */
    public function send(Message $message)
    {
        $this->mailer
            ->send(
                $message->toSwiftMessage()
            );
    }
}
