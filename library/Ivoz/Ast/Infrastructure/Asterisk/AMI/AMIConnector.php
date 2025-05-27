<?php

namespace Ivoz\Ast\Infrastructure\Asterisk\AMI;

use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerRepository;
use Psr\Log\LoggerInterface;

class AMIConnector
{
    public const SERVER_CONNECTION_ERROR = 9001;
    public const SERVER_AUTH_ERROR = 9002;


    public function __construct(
        private ApplicationServerRepository $applicationServerRepository,
        private LoggerInterface $logger,
        private string $userName,
        private string $password,
        private string $port
    ) {
        $this->applicationServerRepository = $applicationServerRepository;
        $this->logger = $logger;

        $this->userName = $userName;
        $this->password = $password;
        $this->port = $port;
    }

    /** @return resource **/
    private function login(string $host)
    {
        $socket = fsockopen($host, (int) $this->port, $errno, $errstr, 30);
        if (!$socket) {
            $this->logger->error("Could not connect to AMI: $errstr ($errno)");
            throw new \DomainException(
                sprintf("Failed to connect to Application server at %s:%d", $host, $this->port),
                self::SERVER_CONNECTION_ERROR
            );
        }

        // Read welcome banner
        fread($socket, 4096);

        $login = "Action: Login\r\nUsername: {$this->userName}\r\nSecret: {$this->password}\r\n\r\n";
        fwrite($socket, $login);

        $response = fread($socket, 4096);
        if (!empty($response) && strpos($response, 'Message: Authentication accepted') === false) {
            $this->logger->error("AMI login failed: $response");
            fclose($socket);
            throw new \DomainException(
                sprintf("Failed to authenticate Application server at %s:%d", $host, $this->port),
                self::SERVER_AUTH_ERROR
            );
        }

        return $socket;
    }

    public function mailboxRefresh(string $mailbox): void
    {
        /** @var ApplicationServer[] $applicationServers */
        $applicationServers = $this->applicationServerRepository->findAll();

        foreach ($applicationServers as $applicationServer) {
            try {
                $asAddress = $applicationServer->getIp();
                $asName = $applicationServer->getName();
                $socket = $this->login($asAddress);

                $action = "Action: VoicemailRefresh\r\nMailbox: $mailbox\r\n\r\n";
                fwrite($socket, $action);
                fclose($socket);
                $this->logger->info("Mailbox refresh completed on $asName");
            } catch (\Exception $e) {
                $this->logger->error("Error refreshing mailbox: " . $e->getMessage());
            }
        }
    }
}
