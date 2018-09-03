<?php

namespace Ivoz\Core\Domain\Model\Mailer;

class Message
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $fromAddress;

    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $toAddress;

    public function __constructor()
    {
    }

    /**
     * @return \Swift_Message
     */
    public function toSwiftMessage()
    {
        $message = new \Swift_Message();
        $message
            ->setBody($this->getBody(), 'text/html')
            ->setSubject($this->getSubject())
            ->setFrom($this->getFromAddress(), $this->getFromName())
            ->setTo($this->getToAddress());

        return $message;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Message
     */
    public function setBody(string $body): Message
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Message
     */
    public function setSubject(string $subject): Message
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromAddress(): string
    {
        return $this->fromAddress;
    }

    /**
     * @param string $fromAddress
     * @return Message
     */
    public function setFromAddress(string $fromAddress): Message
    {
        $this->fromAddress = $fromAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     * @return Message
     */
    public function setFromName(string $fromName): Message
    {
        $this->fromName = $fromName;
        return $this;
    }

    /**
     * @return string
     */
    public function getToAddress(): string
    {
        return $this->toAddress;
    }

    /**
     * @param string $toAddress
     * @return Message
     */
    public function setToAddress(string $toAddress): Message
    {
        $this->toAddress = $toAddress;
        return $this;
    }
}
