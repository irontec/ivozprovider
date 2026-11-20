<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Service\User\CsvRowFormatter;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class CsvRowFormatterSpec extends ObjectBehavior
{
    use HelperTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(CsvRowFormatter::class);
    }

    function it_formats_the_import_columns_in_order_without_the_terminal_password()
    {
        $terminal = $this->getInstance(
            Terminal::class,
            [
                'name' => 'alice_t21',
                'password' => 'Zx9*abc123DEF',
                'mac' => '001565aabbcc',
                'terminalModel' => $this->getInstance(TerminalModel::class, ['iden' => 'YealinkT21P_E2']),
            ]
        );
        $ddi = $this->getInstance(
            Ddi::class,
            [
                'id' => 7,
                'ddi' => '944000301',
                'country' => $this->getInstance(Country::class, ['code' => 'ES']),
                'ddiProvider' => $this->getInstance(DdiProvider::class, ['name' => 'DDIProviderName']),
            ]
        );
        $user = $this->givenPersistedUser(
            [
                'name' => 'Alice',
                'lastname' => 'Allison',
                'email' => 'alice@example.com',
                'company' => $this->getInstance(Company::class, ['id' => 1]),
                'terminal' => $terminal,
                'extension' => $this->getInstance(Extension::class, ['number' => '301']),
                'outgoingDdi' => $ddi,
            ]
        );

        $row = $this->execute($user);

        $row->shouldBe([
            'Alice',
            'Allison',
            'alice@example.com',
            'alice_t21',
            '',
            'YealinkT21P_E2',
            '001565aabbcc',
            '301',
            'ES',
            '944000301',
            'DDIProviderName',
        ]);
        $row->shouldHaveCount(count(CsvStaticValidator::COLUMNS));
    }

    function it_leaves_empty_the_columns_of_the_missing_data()
    {
        $terminal = $this->getInstance(
            Terminal::class,
            [
                'name' => 'bob_t21',
                'password' => 'Zx9*abc123DEF',
                'mac' => null,
                'terminalModel' => null,
            ]
        );
        $ddi = $this->getInstance(
            Ddi::class,
            [
                'id' => 8,
                'ddi' => '944000302',
                'country' => $this->getInstance(Country::class, ['code' => 'ES']),
                'ddiProvider' => null,
            ]
        );
        $user = $this->givenPersistedUser(
            [
                'name' => 'Bob',
                'lastname' => 'Bobson',
                'email' => null,
                'company' => $this->getInstance(Company::class, ['id' => 1]),
                'terminal' => $terminal,
                'extension' => null,
                'outgoingDdi' => $ddi,
            ]
        );

        $this
            ->execute($user)
            ->shouldBe(['Bob', 'Bobson', '', 'bob_t21', '', '', '', '', 'ES', '944000302', '']);
    }

    function it_leaves_the_ddi_empty_when_the_user_falls_back_to_the_client_ddi()
    {
        $clientDdi = $this->getInstance(Ddi::class, ['id' => 9, 'ddi' => '944000300']);
        $company = $this->getInstance(Company::class, ['id' => 1, 'outgoingDdi' => $clientDdi]);
        $user = $this->givenPersistedUser(
            [
                'name' => 'Carol',
                'lastname' => 'Smith',
                'email' => 'carol@example.com',
                'company' => $company,
                'terminal' => null,
                'extension' => null,
                'outgoingDdi' => null,
            ]
        );

        $this
            ->execute($user)
            ->shouldBe(['Carol', 'Smith', 'carol@example.com', '', '', '', '', '', '', '', '']);
    }

    /**
     * @param array<string, mixed> $data
     */
    private function givenPersistedUser(array $data): User
    {
        /** @var User $user */
        $user = $this->getInstance(User::class, ['id' => 1] + $data);
        $user->initChangelog();

        return $user;
    }
}
