<?php

namespace Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

/**
 * Class UpdateByUser
 */
class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = 10;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param UserInterface $user
     *
     * @return void
     */
    public function execute(UserInterface $user)
    {
        $contact = $user->getContact();

        /** @var ContactDto $concatDto */
        $concatDto = is_null($contact)
            ? new ContactDto()
            : $this->entityTools->entityToDto($contact);

        // User company
        $company = $user->getCompany();

        // User extension
        $extension = $user->getExtension();
        $extensionNumber = is_null($extension)
            ? ""
            : $extension->getNumber();

        $concatDto
            ->setCompanyId($company->getId())
            ->setUserId($user->getId())
            ->setName($user->getName())
            ->setLastname($user->getLastname())
            ->setEmail($user->getEmail())
            ->setOtherPhone($extensionNumber);

        $this->entityTools->persistDto(
            $concatDto,
            $contact
        );
    }
}
