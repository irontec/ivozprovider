<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Mailer;

use Ivoz\Core\Domain\Model\Mailer\Message;

class Client
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

    public function send(Message $message)
    {
        $this->mailer
            ->send(
                $message->toSwiftMessage()
            );
    }
}
