<?php

use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

class Provision_IndexController extends Zend_Controller_Action
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    public $logger;

    /**
     * @var \Ivoz\Core\Application\Service\DataGateway
     */
    public $dataGateway;

    public function init()
    {
        $this->logger = Zend_Registry::get('logger');
        $this->dataGateway = Zend_Registry::get('data_gateway');

        $this->_logRequest();
    }

    public function indexAction()
    {
        // action body
    }

    public function templateAction()
    {
        $isHttps = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']);
        if ($isHttps && $_SERVER['SERVER_PORT'] == 443) {
            return $this->_error(403, "No provisioning over 443");
        }
        $terminalUrl = $this->getRequest()->getParam('requested_url');
        $path = $this->_getFilePath();
        $terminalModel = $this->_searchGenericPattern($terminalUrl);

        if ($terminalModel) {
            // Generic Template requests must be served over HTTP
            if ($isHttps) {
                return $this->_error(403);
            }
            return $this->_renderPage('generic', $path, $terminalModel);
        }

        // Specific Template requests must be served over HTTPS
        if (!$isHttps) {
            return $this->_error(403);
        }

        $terminal = $this->_getTerminalByUrl($terminalUrl);
        if (!$terminal) {
            return $this->_error(404, 'Terminal not found');
        }

        $terminalModel = $terminal->getTerminalModel();
        if (!$terminalModel) {
            return $this->_error(404, 'TerminalModel not found');
        }

        /** @var \Ivoz\Provider\Domain\Model\User\UserDto user */
        $this->view->user = $this->dataGateway->findOneBy(
            \Ivoz\Provider\Domain\Model\User\User::class,
            ['User.terminal = ' . $terminal->getId()]
        );

        if (!$this->view->user) {
            $this->view->language = new LanguageDto();
            $this->view->user = new UserDto();
        } else {

            /** @var \Ivoz\Provider\Domain\Model\Language\LanguageDto $language */
            $language = $this->dataGateway->remoteProcedureCall(
                \Ivoz\Provider\Domain\Model\User\User::class,
                $this->view->user->getId(),
                'getLanguage',
                []
            );
            $this->view->language = $language->toDto();
        }

        /**
         * For backward compatibility reasons
         * @deprecated this will be remove in ivozprovider 3.0
         */
        $this->view->user->setLanguage($this->view->language);

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyDto company */
        $this->view->company = $this->dataGateway->find(
            \Ivoz\Provider\Domain\Model\Company\Company::class,
            $terminal->getCompanyId()
        );

        /** @var \Ivoz\Provider\Domain\Model\Brand\BrandDto brand */
        $this->view->brand = $this->dataGateway->find(
            \Ivoz\Provider\Domain\Model\Brand\Brand::class,
            $this->view->company->getBrandId()
        );
        $this->view->terminal = $terminal;

        $this->_renderPage('specific', $path, $terminalModel);
    }

    protected function _error($errorNumber, $logMessage = null)
    {
        if ($logMessage) {
            $this->logger->error($logMessage);
        }

        $this->getResponse()
            ->clearHeaders()
            ->setHttpResponseCode($errorNumber)
            ->sendResponse();
    }

    protected function _renderPage($template, $path, $terminalModel)
    {
        $route =
            $path
            . DIRECTORY_SEPARATOR
            . "Provision_template"
            . DIRECTORY_SEPARATOR
            . $terminalModel->getId();

        $this->view->setScriptPath($route);
        $this->view->terminalModel = $terminalModel;
        $brand = $this->view->brand;
        $terminal = $this->view->terminal;

        if (!is_null($brand) && !is_null($terminal)) {
            $this->logger->debug('[b' . $brand->getId() . '] ' . $terminal->getMac() . ' ' . $template . ' url match found');
            $this->logger->debug('[b' . $brand->getId() . '] ' . $terminal->getMac() . " Response: \n" . $this->view->render($template . '.phtml'));
        } else {
            $this->logger->debug($template . ' url match found');
            $this->logger->debug('Response: ' . $this->view->render($template . '.phtml'));
        }
        $this->render($template, 'page', true);

        if (!is_null($terminal)) {
            $now = new \DateTime(null, new \DateTimeZone('UTC'));
            $terminal->setLastProvisionDate($now->format('Y-m-d H:i:s'));
            $this->dataGateway->update(
                \Ivoz\Provider\Domain\Model\Terminal\Terminal::class,
                $terminal
            );
        }
    }

    protected function _searchGenericPattern($terminalUrl)
    {
        $criteriaTemplate = "TerminalModel.genericUrlPattern = '%s'";

        $criteria = [ sprintf($criteriaTemplate, "/$terminalUrl") ];
        $terminalModel = $this->dataGateway->findOneBy(
            \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel::class,
            $criteria
        );

        if ($terminalModel == null) {
            $criteria = [ sprintf($criteriaTemplate, "$terminalUrl") ];
            $terminalModel = $this->dataGateway->findOneBy(
                \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel::class,
                $criteria
            );
        }

        if ($terminalModel == null) {
            $criteria = [ sprintf($criteriaTemplate, preg_replace("/^\//", "", $terminalUrl)) ];
            $terminalModel = $this->dataGateway->findOneBy(
                \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel::class,
                $criteria
            );
        }

        return $terminalModel;
    }

    /**
     * @param string $terminalUrl
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalDto|null
     */
    protected function _getTerminalByUrl($terminalUrl)
    {
        $fileName = $this->extractFileName($terminalUrl);
        $fileExtension = $this->extractFileExtension($terminalUrl);

        if (empty($fileName)) {
            return null;
        }

        $macRegExp = '/(?=(([0-9a-f]{2}[:-]{0,1}){5}([0-9a-f]){2}))/i';
        preg_match_all($macRegExp, $fileName, $matches);
        $macCandidates = array_key_exists(1, $matches)
            ? $matches[1]
            : null;

        array_walk($macCandidates, function (&$value, $key) {
            // We only allow a-f0-9 for macs in database
            // ensure that format in results
            $value = preg_replace('/[^0-9a-f]/i', '', $value);
        });

        if (empty($macCandidates)) {
            return null;
        }

        /**
         * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalDto[] $terminals
         */
        $terminals = $this->dataGateway->findBy(
            \Ivoz\Provider\Domain\Model\Terminal\Terminal::class,
            ["Terminal.mac IN ('". implode("','", $macCandidates) ."')"]
        );

        foreach ($terminals as $candidate) {
            $terminalModelId = $candidate->getTerminalModelId();
            if (!$terminalModelId) {
                continue;
            }

            /** @var \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto $terminalModel */
            $terminalModel = $this->dataGateway->find(
                \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel::class,
                $terminalModelId
            );
            if (!$terminalModel) {
                continue;
            }

            $specificUrl = $this->extractFileName(
                $terminalModel->getSpecificUrlPattern()
            );

            $specificUrlExtension = $this->extractFileExtension(
                $terminalModel->getSpecificUrlPattern()
            );

            $fixedUrlSegments = explode('{mac}', strtolower($specificUrl), 2);
            $fixedSpecificUrl = str_ireplace('{mac}', $candidate->getMac(), $specificUrl);

            $fixedFileName = $fileName;
            if (count($fixedUrlSegments) > 1) {
                $start = strlen($fixedUrlSegments[0]);
                $end = strlen($fixedUrlSegments[1]) * -1;

                $fileNameMac = $end < 0
                    ? substr($fileName, $start, $end)
                    : substr($fileName, $start);
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

    protected function extractFileName($route)
    {
        return pathinfo($route, PATHINFO_FILENAME);
    }

    protected function extractFileExtension($route)
    {
        return pathinfo($route, PATHINFO_EXTENSION);
    }

    protected function _getFilePath()
    {
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $conf = (Object) $bootstrap->getOptions();
        $path = $conf->Iron['fso']['localStoragePath'];
        return $path;
    }

    private function _logRequest()
    {

        $module = $this->_request->getParam("module");
        $controller = $this->_request->getParam("controller");
        $action = $this->_request->getParam("action");

        $requestLog = $module . "/" . $controller . "::". $action;

        $params = $this->_request->getParams();

        foreach (array('module', 'controller', 'action') as $key) {
            unset($params[$key]);
        }

        $requestParamString = var_export($params, true);

        $requestLog .= " from " . $_SERVER["REMOTE_ADDR"];

        $this->logger->debug(
            "Requesting " . $requestLog
        );

        $resquestParams = str_replace("\n", "", $requestParamString);

        $this->logger->debug(
            "Request params: " . $resquestParams
        );
    }
}
