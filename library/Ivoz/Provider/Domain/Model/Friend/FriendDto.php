<?php

namespace Ivoz\Provider\Domain\Model\Friend;

class FriendDto extends FriendDtoAbstract
{
    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        if (!$hideSensitiveData) {
            return $response;
        }
        $response['password'] = '****';

        return $response;
    }
}


