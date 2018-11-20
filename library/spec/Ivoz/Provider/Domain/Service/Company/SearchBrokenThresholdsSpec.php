<?php

namespace spec\Ivoz\Provider\Domain\Service\Company;

use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Service\Company\SearchBrokenThresholds;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Events\CompanyBalanceThresholdWasBroken;
use spec\HelperTrait;

class SearchBrokenThresholdsSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var BalanceNotificationRepository
     */
    protected $balanceNotificationRepository;

    /**
     * @var DomainEventPublisher
     */
    protected $domainEventPublisher;

    public function let(
        BalanceNotificationRepository $balanceNotificationRepository,
        DomainEventPublisher $domainEventPublisher
    ) {
        $this->balanceNotificationRepository = $balanceNotificationRepository;
        $this->domainEventPublisher = $domainEventPublisher;

        $this->beConstructedWith(
            $this->balanceNotificationRepository,
            $this->domainEventPublisher
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SearchBrokenThresholds::class);
    }

    function it_does_nothing_on_new_companies(
        CompanyInterface $company
    ) {
        $company->isNew()->willReturn(true);

        $this->execute($company);
    }

    function it_does_nothing_on_unchanged_balance(
        CompanyInterface $company
    ) {
        $this->getterProphecy(
            $company,
            [
                'isNew' => false,
                'hasChanged' => function () {
                    return [['balance'], false];
                }
            ],
            true
        );

        $this->execute($company);
    }

    function it_does_nothing_on_balance_increments(
        CompanyInterface $company
    ) {
        $this->getterProphecy(
            $company,
            [
                'isNew' => false,
                'hasChanged' => function () {
                    return [['balance'], true];
                },
                'getInitialValue' => function () {
                    return [['balance'], 10];
                },
                'getBalance' => 100
            ],
            true
        );

        $this->domainEventPublisher
            ->publish(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($company);
    }

    function it_triggers_domain_events(
        CompanyInterface $company,
        BalanceNotificationInterface $brokenThreshold
    ) {
        $this->getterProphecy(
            $company,
            [
                'isNew' => false,
                'hasChanged' => function () {
                    return [['balance'], true];
                },
                'getInitialValue' => function () {
                    return [['balance'], 100];
                },
                'getBalance' => 10
            ],
            true
        );

        $this->balanceNotificationRepository
            ->findBrokenThresholdsByCompany(
                $company,
                Argument::type('numeric'),
                Argument::type('numeric')
            )
            ->shouldBecalled()
            ->willReturn([$brokenThreshold]);

        $this->getterProphecy(
            $brokenThreshold,
            [
                'getId' => 1,
                'getThreshold' => 100
            ]
        );

        $this->domainEventPublisher
            ->publish(Argument::type(CompanyBalanceThresholdWasBroken::class))
            ->shouldBeCalled();

        $this->execute($company);
    }
}
