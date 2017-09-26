<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\User
 * @lifecycle pre_persist
 */
class SanitizeValues implements UserLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(UserInterface $entity, $isNew)
    {
        if ($entity->getEmail() === '') {
            // '' is NULL (avoid triggering the UNIQUE KEY)
            $entity->setEmail(null);
        }

        if ($isNew) {
            return $this->sanitizeNewEntity($entity);
        }

        $canAccessUserweb = ($entity->getActive() && $entity->getEmail());
        if ($canAccessUserweb) {
            // Avoid username/pass/active incoherences
            if (!$entity->getPass()) {
                $entity->setPass("1234");
            }
        } else {
            $entity->setActive(0);
            $entity->setPass(null);
        }

        if (!$entity->getEmail()) {
            // If no mail, no SendMail
            $entity->setVoicemailSendMail(0);
        }
    }

    protected function sanitizeNewEntity(UserInterface $entity)
    {
        // Sane defaults for hidden fields
        if (!$entity->getTimezone()) {

            /**
             * @todo create a shortcut
             */
            $brandDefaultTimezone = $entity
                ->getCompany()
                ->getBrand()
                ->getDefaultTimezone();

            $entity->setTimezone(
                $brandDefaultTimezone
            );
        }

        if (is_null($entity->getVoicemailSendMail()) && $entity->getEmail()) {
            $entity->setVoicemailSendMail(1);
        }

        if ($entity->getEmail()) {
            $entity->setActive(1);
            /**
             * @todo should we move this to the frontend?
             */
            $entity->setPass("1234");
        }
    }
}