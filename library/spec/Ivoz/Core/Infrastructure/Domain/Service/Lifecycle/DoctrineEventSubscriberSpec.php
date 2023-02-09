<?php

namespace spec\Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\CommandPersister;
use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\DoctrineEventSubscriber;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleServiceCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Domain\Service\PersistErrorHandlerServiceCollection;
use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnErrorEventArgs;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Core\Domain\Service\CommonLifecycleServiceCollection;

class DoctrineEventSubscriberSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $em;
    protected $serviceContainer;
    protected $eventPublisher;
    protected $commandPersister;
    protected $forcedEntityChangeLog;

    function let()
    {
        $this->serviceContainer = $this->getTestDouble(ContainerInterface::class);
        $this->em = $this->getTestDouble(EntityManagerInterface::class);
        $this->eventPublisher = $this->getTestDouble(DomainEventPublisher::class);
        $this->commandPersister = $this->getTestDouble(CommandPersister::class);
        $this->forcedEntityChangeLog = false;

        $connection = $this->getTestDouble(Connection::class);
        $schemaManager = $this->getTestDouble(AbstractSchemaManager::class);

        $this->em
            ->getConnection()
            ->willReturn($connection);

        $connection
            ->createSchemaManager()
            ->willReturn($schemaManager);

        $this->beConstructedWith(
            $this->serviceContainer,
            $this->em,
            $this->eventPublisher,
            $this->commandPersister,
            $this->forcedEntityChangeLog
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DoctrineEventSubscriber::class);
    }

    function it_triggers_entity_specific_error_handler()
    {
        $errorEvent = $this->getErrorEvent();

        $handlerServiceName =  'provider.lifecycle.company.service_collection';
        $handlerService = $this->getTestDouble(
            PersistErrorHandlerInterface::class
        );
        /** @var CompanyLifecycleServiceCollection $serviceCollection */
        $serviceCollection = $this->getInstance(
            CompanyLifecycleServiceCollection::class
        );
        $serviceCollection->setServices(
            'error_handler',
            [$handlerService->reveal()]
        );

        $this->getterProphecy(
            $this->serviceContainer,
            [
                'has' => function () use ($handlerServiceName) {
                    return [[$handlerServiceName], true];
                },
                'get' => function () use ($handlerServiceName, $serviceCollection) {
                    return [[$handlerServiceName], $serviceCollection];
                }
            ]
        );

        $this
            ->serviceContainer
            ->get(CommonLifecycleServiceCollection::class)
            ->shouldNotBeCalled();

        $handlerService
            ->handle(Argument::type(\Exception::class))
            ->shouldBeCalled()
            ->willThrow(new \DomainException('expected response'));

        $this
            ->shouldThrow('\DomainException')
            ->during('onError', [$errorEvent]);
    }

    function it_triggers_common_error_handler_as_fallback()
    {
        $errorEvent = $this->getErrorEvent();

        $handlerServiceName =  'provider.lifecycle.company.service_collection';
        $handlerService = $this->getTestDouble(
            PersistErrorHandlerInterface::class
        );
        /** @var CompanyLifecycleServiceCollection $serviceCollection */
        $serviceCollection = $this->getInstance(
            CompanyLifecycleServiceCollection::class
        );
        $serviceCollection->setServices(
            'error_handler',
            [$handlerService->reveal()]
        );

        $this->getterProphecy(
            $this->serviceContainer,
            [
                'has' => function () use ($handlerServiceName) {
                    return [[$handlerServiceName], true];
                },
                'get' => function () use ($handlerServiceName, $serviceCollection) {
                    return [[$handlerServiceName], $serviceCollection];
                }
            ]
        );

        /** @var CompanyLifecycleServiceCollection $commonServiceCollection */
        $commonServiceCollection = $this->getTestDouble(
            CompanyLifecycleServiceCollection::class
        );

        $this
            ->serviceContainer
            ->get(CommonLifecycleServiceCollection::class)
            ->willReturn($commonServiceCollection)
            ->shouldBeCalled();

        $commonServiceCollection
            ->handle(Argument::type(\Exception::class))
            ->shouldBeCalled()
            ->willThrow(new \RuntimeException('expected response'));


        $this
            ->shouldThrow('\RuntimeException')
            ->during('onError', [$errorEvent]);
    }

    /**
     * @return array
     */
    private function getErrorEvent()
    {
        $entity = $this->getInstance(
            Company::class
        );
        $exception = new \Exception('test exception');
        $errorEvent = $this->getTestDouble(
            OnErrorEventArgs::class
        );

        $errorEvent
            ->getEntity()
            ->willReturn($entity);

        $errorEvent
            ->getException()
            ->willReturn($exception);

        return $errorEvent;
    }
}
