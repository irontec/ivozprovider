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
    protected $bodyType;

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

    protected $attachment;

    /**
     * @return \Swift_Message
     */
    public function toSwiftMessage()
    {
        $message = new \Swift_Message();
        $message
            ->setBody($this->getBody(), $this->getBodyType())
            ->setSubject($this->getSubject())
            ->setFrom($this->getFromAddress(), $this->getFromName())
            ->setTo($this->getToAddress());

        if ($this->attachment) {
            $message->attach($this->attachment);
        }

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
     * @return string
     */
    public function getBodyType(): string
    {
        return $this->bodyType;
    }

    /**
     * @param string $body
     * @param string $bodyType
     * @return Message
     */
    public function setBody(string $body, string $bodyType = 'text/plain'): Message
    {
        $this->body = $body;
        $this->bodyType = $bodyType;
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

    /**
     * @return void
     */
    public function setAttachment($file, $filename, $mimetype)
    {
        $this->attachment = \Swift_Attachment::fromPath($file, $mimetype);
        $this->attachment->setFilename(
            $filename
        );
    }
}
