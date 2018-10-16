<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface VoicemailRepository extends ObjectRepository, Selectable
{
    /**
     * @param $id
     * @return VoicemailInterface
     */
    public function findOneByUserId($id);
}
