<?php

namespace Ivoz\Provider\Domain\Traits;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * RoutableTrait
 *
 */
trait RoutableTrait
{
    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget (string $prefix = "")
    {
        // Get DDI Route Type
        $routeTypeGetter = 'get' . $prefix . 'RouteType';
        $routeType = $this->{$routeTypeGetter}();

        switch ($routeType) {
            case '':
                return '';

            case 'number':
                $numberGetter = 'get' . $prefix . 'NumberValueE164';
                return $this->{$numberGetter}();

            case 'user':
                $userGetter = 'get' . $prefix . 'User';
                return sprintf("%s %s",
                    $this->{$userGetter}()->getName(),
                    $this->{$userGetter}()->getLastname()
                );

            case 'conditional':
                $conditionalGetter = 'get' . $prefix . 'ConditionalRoute';
                return $this->{$conditionalGetter}()->getName();

            case 'extension':
                $extensionGetter = 'get' . $prefix . 'Extension';
                return $this->{$extensionGetter}()->getNumber();

            case 'friend':
                $friendGetter = 'get' . $prefix . 'FriendValue';
                return $this->{$friendGetter}();

            case 'voicemail':
                $voicemailGetter = 'get' . $prefix . 'VoicemailUser';
                return sprintf("%s %s",
                    $this->{$voicemailGetter}()->getName(),
                    $this->{$voicemailGetter}()->getLastname()
                );

            default:
                // Get Generic Target Type
                $targetGetter = 'get' . $prefix . ucfirst($routeType);
                $targetEntity = $this->{$targetGetter}();

                // If Target is assigned, get its name
                if ($targetEntity) {
                    return $targetEntity->getName();
                }
                break;
        }

        // Object without routable object assigned
        return null;
    }
}

