<?php

namespace Ivoz\Provider\Domain\Job;

interface RecoderJobInterface
{
    const CHANNEL = 'MultimediaEncode';

    public function setId($id): self;

    public function getId(): int;

    public function setEntityName($entityName): self;

    public function getEntityName(): string;

    public function send(): void;
}
