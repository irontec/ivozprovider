<?php

namespace Model;

class RawRecordingInfo
{
    protected string $fileName;
    protected string $hashid;

    public function __construct(
        protected string $fullFileName,
        protected string $callid,
        protected int $size,
    ) {
        $this->fileName = basename($fullFileName);
        $this->hashid = substr(md5($callid), 0, 8);
    }

    public function getFullName(): string
    {
        return $this->fullFileName;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getHashid(): string
    {
        return $this->hashid;
    }

    public function getCallid(): string
    {
        return $this->callid;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}
