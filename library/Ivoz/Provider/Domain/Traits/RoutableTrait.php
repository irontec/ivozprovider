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
     * Available Route types
     *
     * @var array
     */
    protected $routeTypes = [
        'ivr',
        'huntGroup',
        'user',
        'conferenceRoom',
        'number',
        'friend',
        'queue',
        'voicemail',
        'extension',
        'retail',
        'conditional',
        'fax',
        'residential',
        'retail'
    ];

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = "")
    {
        // Get Route Type
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
                if (!$this->{$userGetter}()) {
                    return "";
                }
                return sprintf(
                    "%s %s",
                    $this->{$userGetter}()->getName(),
                    $this->{$userGetter}()->getLastname()
                );

            case 'conditional':
                $conditionalGetter = 'get' . $prefix . 'ConditionalRoute';
                if (!$this->{$conditionalGetter}()) {
                    return "";
                }
                return $this->{$conditionalGetter}()->getName();

            case 'extension':
                $extensionGetter = 'get' . $prefix . 'Extension';
                if (!$this->{$extensionGetter}()) {
                    return "";
                }
                return $this->{$extensionGetter}()->getNumber();

            case 'friend':
                $friendGetter = 'get' . $prefix . 'FriendValue';
                if (!$this->{$friendGetter}()) {
                    return "";
                }
                return $this->{$friendGetter}();

            case 'voicemail':
                $voicemailGetter = 'get' . $prefix . 'VoicemailUser';
                if (!$this->{$voicemailGetter}()) {
                    return "";
                }
                return sprintf(
                    "%s %s",
                    $this->{$voicemailGetter}()->getName(),
                    $this->{$voicemailGetter}()->getLastname()
                );

            case 'residential':
                $residentialGetter = 'get' . $prefix . 'ResidentialDevice';
                if (!$this->{$residentialGetter}()) {
                    return "";
                }
                return $this->{$residentialGetter}()->getName();

            case 'retail':
                $retailGetter = 'get' . $prefix . 'RetailAccount';
                if (!$this->{$retailGetter}()) {
                    return "";
                }
                return $this->{$retailGetter}()->getName();

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

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    protected function sanitizeRouteValues(string $prefix = "")
    {
        $routeTypeGetter = 'get' . $prefix . 'RouteType';
        $routeType = $this->{$routeTypeGetter}();

        $nullableFields = [
            'ivr'            => 'Ivr',
            'huntGroup'      => 'HuntGroup',
            'user'           => 'User',
            'conferenceRoom' => 'ConferenceRoom',
            'number'         => [ 'NumberValue', 'NumberCountry' ],
            'friend'         => 'FriendValue',
            'queue'          => 'Queue',
            'voicemail'      => 'VoicemailUser',
            'extension'      => 'Extension',
            'residential'    => 'ResidentialDevice',
            'conditional'    => 'ConditionalRoute',
            'fax'            => 'Fax'
        ];

        foreach ($nullableFields as $type => $fieldNames) {
            if ($routeType == $type) {
                continue;
            }

            if (!in_array($type, $this->routeTypes)) {
                continue;
            }

            $fieldNames = is_array($fieldNames)
                ? $fieldNames
                : [$fieldNames];

            foreach ($fieldNames as $fieldName) {
                $setter = 'set' . $prefix . $fieldName;
                if (method_exists($this, $setter)) {
                    $this->{$setter}(null);
                }
            }
        }
    }
}
