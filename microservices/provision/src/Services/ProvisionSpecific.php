<?php

namespace Services;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;

class ProvisionSpecific
{
    public function __construct(
        private UserRepository $userRepository,
        private TerminalRepository $terminalRepository,
        private EntityTools $entityTools,
        private string $storagePath
    ) {
    }

    public function execute(
        string $mac
    ): string {

        $terminal = $this->getTerminalByUrl($mac);
        if (!$terminal) {
            throw new \DomainException('Terminal not found for url ' . $mac, 404);
        }

        $user = $this
            ->userRepository
            ->findOneByTerminalId(
                $terminal->getId()
            );

        if (!$user) {
            throw new \DomainException('User not found', 404);
        }

        $extension = $user->getExtension();
        if (!$extension) {
            throw new \DomainException('Extension not found', 404);
        }

        $language = $user->getLanguage();
        $company = $terminal->getCompany();
        $brand = $company->getBrand();
        /** @var TerminalModelInterface $terminalModel */
        $terminalModel = $terminal->getTerminalModel();

        /** @var array<string, EntityInterface> $args */
        $args = [
            'terminalModel' => $terminalModel,
            'user' => $user,
            'terminal' => $terminal,
            'brand' => $brand,
            'extension' => $extension,
            'language' => $language,
            'company' => $company
        ];

        /** @var array<string, DataTransferObjectInterface> $argsDto */
        $argsDto = [];

        foreach ($args as $key => $entity) {
            $argsDto[$key] = $this->entityTools->entityToDto($entity);
        }

        return $this->renderTemplate(
            $terminalModel,
            $argsDto
        );
    }

    /**
     * @param array<string, DataTransferObjectInterface> $args
     */
    private function renderTemplate(
        TerminalModelInterface $terminalModel,
        array $args
    ): string {
        $route =
            $this->storagePath
            . DIRECTORY_SEPARATOR
            . "Provision_template"
            . DIRECTORY_SEPARATOR
            . (int) $terminalModel->getId()
            . DIRECTORY_SEPARATOR;

        $path = $route . 'specific.phtml';

        $renderer = new TemplateRenderer(
            $path,
            $args
        );

        return $renderer->execute();
    }

    private function getTerminalByUrl(string $specificUrlPattern): ?TerminalInterface
    {
        $fileExtension = $this->extractFileExtension($specificUrlPattern);

        $macRegExp = '/(?=(([0-9a-f]{2}[:-]{0,1}){5}([0-9a-f]){2}))/i';
        preg_match_all($macRegExp, $specificUrlPattern, $matches);

        $candidates = array_key_exists(1, $matches)
            ? $matches[1]
            : null;

        if (empty($candidates)) {
            return null;
        }

        array_walk($candidates, function (string &$value) {
            // We only allow a-f0-9 for macs in database
            // ensure that format in results
            $value = preg_replace('/[^\da-f]/i', '', $value);
        });

        /** @var array<string> $macCandidates */
        $macCandidates = $candidates;

        /** @var TerminalInterface[]  $terminals */
        $terminals = $this
            ->terminalRepository
            ->findByMacs($macCandidates);

        foreach ($terminals as $candidate) {
            $terminalModel = $candidate->getTerminalModel();
            if (! $terminalModel) {
                continue;
            }

            $specificUrl = $this->extractFileName(
                $terminalModel->getSpecificUrlPattern()
            );
            $specificUrlExtension = $this->extractFileExtension(
                $specificUrlPattern
            );
            $fixedUrlSegments = explode('{mac}', strtolower($specificUrl), 2);
            $fixedSpecificUrl = str_ireplace('{mac}', (string) $candidate->getMac(), $specificUrl);

            $fixedFileName = $specificUrlPattern;

            if (count($fixedUrlSegments) > 1) {
                $start = strlen($fixedUrlSegments[0]);

                /** @var int<min, 0> $end */
                $end = strlen($fixedUrlSegments[1]) * -1;

                $fileNameMac = $end < 0
                    ? substr($specificUrlPattern, $start, $end)
                    : substr($specificUrlPattern, $start);

                $fileNameMac = preg_replace('/[\:\-]/', '', $fileNameMac);

                $fixedFileName = $fixedUrlSegments[0] . $fileNameMac . $fixedUrlSegments[1];
            }

            if (strtolower($fixedSpecificUrl) === strtolower($fixedFileName)) {
                $extensionMismatch = ($fileExtension !== $specificUrlExtension);
                if (!empty($specificUrlExtension) && $extensionMismatch) {
                    continue;
                }

                return $candidate;
            }
        }

        return null;
    }

    protected function extractFileExtension(string $route): string
    {
        return pathinfo($route, PATHINFO_EXTENSION);
    }

    protected function extractFileName(string|null $route): string
    {
        if (is_null($route)) {
            return '';
        }

        return pathinfo($route, PATHINFO_FILENAME);
    }
}
