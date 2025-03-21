<?php

namespace Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

/**
 * Class UpdateByExtension
 * @package Ivoz\Provider\Domain\Service\Contact
 */
class UpdateByExtension implements ExtensionLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param ExtensionInterface $extension
     *
     * @return void
     */
    public function execute(ExtensionInterface $extension)
    {
        // Ignore non-user extensions
        $user = $extension->getUser();
        if (!$user) {
            return;
        }

        // Only apply to user's with extension
        $userExtension = $user->getExtension();
        if (!$userExtension) {
            return;
        }

        // Only apply if the extension changed is user's screen extension
        if ($extension->getId() != $userExtension->getId()) {
            return;
        }

        $contact = $user->getContact();
        if (!$contact) {
            return;
        }

        /** @var ContactDto $concatDto */
        $concatDto = $this->entityTools->entityToDto($contact);
        $concatDto->setOtherPhone($extension->getNumber());

        $this->entityTools->persistDto(
            $concatDto,
            $contact
        );
    }
}
