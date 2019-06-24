<?php

namespace spec\Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\CommandPersister;
use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\DoctrineEventSubscriber;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Domain\Service\PersistErrorHandlerServiceCollection;
use \Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;
use \Ivoz\Core\Infrastructure\Persistence\Doctrine\OnErrorEventArgs;
use \Ivoz\Provider\Domain\Model\Company\Company;

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

        $handlerServiceName =  'provider.lifecycle.company.error_handler';
        $handlerService = $this->getTestDouble(
            PersistErrorHandlerInterface::class
        );
        /** @var PersistErrorHandlerServiceCollection $handlerCollection */
        $handlerCollection = $this->getInstance(
            PersistErrorHandlerServiceCollection::class
        );
        $handlerCollection->setServices([$handlerService->reveal()]);

        $this->getterProphecy(
            $this->serviceContainer,
            [
                'has' => function () use ($handlerServiceName) {
                    return [[$handlerServiceName], true];
                },
                'get' => function () use ($handlerServiceName, $handlerCollection) {
                    return [[$handlerServiceName], $handlerCollection];
                }
            ]
        );

        $this
            ->serviceContainer
            ->get('lifecycle.common.error_handler')
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

        $handlerServiceName =  'provider.lifecycle.company.error_handler';
        /** @var PersistErrorHandlerServiceCollection $handlerCollection */
        $handlerCollection = $this->getInstance(
            PersistErrorHandlerServiceCollection::class
        );

        $this->getterProphecy(
            $this->serviceContainer,
            [
                'has' => function () use ($handlerServiceName) {
                    return [[$handlerServiceName], true];
                },
                'get' => function () use ($handlerServiceName, $handlerCollection) {
                    return [[$handlerServiceName], $handlerCollection];
                }
            ]
        );

        $commonHandlerCollection = $this->getTestDouble(
            PersistErrorHandlerServiceCollection::class,
            false
        );

        $commonHandlerCollection
            ->execute(Argument::any())
            ->shouldBeCalled()
            ->willThrow(new \RuntimeException('runtime exception'));

        $this
            ->serviceContainer
            ->get('lifecycle.common.error_handler')
            ->willReturn($commonHandlerCollection);

        $this
            ->shouldThrow('\Exception')
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
