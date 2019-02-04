<?php

class FsoController extends \Zend_Controller_Action
{

    /**
     * Multiplicador de tamaños de las imagenes. Las vistas normales son x1
     * y las vistas retina son x2 y x3, según el dispositivo.
     * @var integer
     */
    protected $_multiplierRetina = 1;

    protected $_frontInstance;
    protected $_fsoConfig;
    protected $_namespace;

    protected $_routeMap;
    protected $_life;

    protected $_currentProfile;
    protected $_profileType;
    protected $_profileName;
    protected $_ext;

    protected $_cacheDir;
    protected $_model;

    public function init()
    {

        $layout = \Zend_Layout::getMvcInstance();
        if (null !== $layout) {
            $layout->disableLayout();
        }

        $this->_helper->viewRenderer->setNoRender(true);

        $this->_frontInstance = \Zend_Controller_Front::getInstance();

        $this->_namespace = $this->_frontInstance->getParam(
            'bootstrap'
        )->getOption('appnamespace');

        $this->setConfig(
            new \Zend_Config_Ini(
                APPLICATION_PATH . '/configs/fso.ini',
                APPLICATION_ENV
            )
        );

        $this->_routeMap = $this->getConfig('config', 'routeMap');

        $life = $this->getConfig('config', 'life');
        if (is_null($life) || !is_numeric($life)) {
            $life = 9999990;
        }
        $this->_life = $life;

        $this->_cacheDir = $this->getConfig('config', 'cacheDir');
        if (is_null($this->_cacheDir)) {
            $this->_cacheDir = APPLICATION_PATH . '/cache/';
        }

        if (!is_dir($this->_cacheDir)) {
            if (!mkdir($this->_cacheDir)) {
                $msg = sprintf(
                    'No existe y no se puede crear la carpeta de cache: "%s"',
                    $this->_cacheDir
                );

                throw new \Exception($msg, 404);
            }
        }

        $this->_initParams();

        if (isset($this->_currentProfile->preDownloadMethod)) {
            $preDownloadMethod = $this->_currentProfile->preDownloadMethod;
            $this->_model->{$preDownloadMethod}();
        }
    }

    public function indexAction()
    {
        $config = $this->_setConfiguration($this->_currentProfile);

        try {
            $fetchFso = 'get' . ucwords($this->getFso());
            $getPath = $fetchFso . 'Path';
            $getBaseName = $fetchFso . 'BaseName';
            $getMimeType = $fetchFso . 'MimeType';

            $this->setFilePath(
                $this->_model->$getPath()
            );

            $this->setBasename(
                $this->_model->$getBaseName()
            );

            $this->setMimeType(
                $this->_model->$getMimeType()
            );
        } catch (\Exception $e) {
            throw new Zend_Controller_Action_Exception(
                'File not found',
                404
            );
        }

        if (isset($this->_currentProfile->onDownloadMethod)) {
            $onDownloadMethod = $this->_currentProfile->onDownloadMethod;
            $this->_model->{$onDownloadMethod}();
        }

        if ($this->_profileType === 'binary') {
            if (isset($this->_currentProfile->disposition)) {
                $this->_downloadFile(
                    $this->_currentProfile->disposition
                );
            } else {
                $this->_downloadFile();
            }
        } elseif ($this->_profileType === 'image') {
            $this->_showImage($config);
        }
    }

    /**
     * Define la configuración guardada en el fso.ini
     * @param string $config Objeto de Zend con toda la configuración cargada
     * @return Fso_IndexController
     */
    public function setConfig($config)
    {
        $this->_fsoConfig = $config;
        return $this;
    }

    /**
     * Obtiene la configuración del fso.ini
     * @param string $config Nombre de la configuración que se quiere
     * @param string $item Elemento de la configuración que se quiere
     * @return null|string
     */
    public function getConfig($config, $item = false)
    {
        $data = $this->_fsoConfig->get($config);
        if (is_null($data)) {
            return $data;
        }

        if ($item === false) {
            return $data;
        }

        return $data->get($item);
    }

    protected function _downloadFile($contentDisposition = 'attachment')
    {

        $finfo = new finfo();
        $mimeType = $finfo->file(
            $this->getFilePath(),
            FILEINFO_MIME
        );

        $headers = array(
            'filename' => $this->getBaseName(),
            'Content-Disposition' => $contentDisposition,
            'Pragma' => 'public',
            'Cache-Control' => 'public',
            'Content-Type' => $mimeType,
            'Content-transfer-encoding' => 'binary'
        );

        $file = new Iron_Controller_Action_Helper_SendPartialFileToClient();
        $file->sendFile($this->getFilePath(), $headers);
    }

    protected function _showImage($config)
    {

        $frontend = array(
            'lifetime' => $this->_life,
            'automatic_serialization' => true
        );

        $backend = array(
            'cache_dir' => $this->_cacheDir,
        );

        $cache = \Zend_Cache::factory(
            'core',
            'File',
            $frontend,
            $backend
        );

        $piecesKey = array(
            ucfirst($this->_profileName),
            ucfirst(str_replace('-', '', $this->_currentProfile->changeSize)),
            ucfirst($this->getFso()),
            $this->getMultiplierRetina() . 'x'
        );

        $key = implode('', $piecesKey);

        $finfo = new finfo();
        $filePath = $this->getFilePath();

        if (!file_exists($filePath)) {
            throw new \Zend_Controller_Action_Exception(
                'File does not exist',
                404
            );
        }

        $mimeType = $finfo->file(
            $this->getFilePath(),
            FILEINFO_MIME
        );

        $fileMTime = filemtime($this->getFilePath());

        $cacheKey = md5(
            $fileMTime . '-' . $this->getBasename()
        ) . $key;

        \Zend_Registry::set('cache', $cache);

        $cache = \Zend_Registry::get('cache');

        $loadCache = $cache->load($cacheKey);

        if (!is_null($this->_ext)) {
            $extension = $this->_ext;
        } else {
            $extension = substr(strrchr($this->getBasename(), '.'), 1);
        }

        if (empty($loadCache)) {
            $file = $this->_prepareImageFile($extension, $config);
            $cache->save($file, $cacheKey);

            $this->getHeaders(false, $cache, $cacheKey, $mimeType);
        } else {
            $request = $this->_frontInstance->getRequest();

            if ($request->getHeader('IF-MODIFIED-SINCE')) {
                $this->getHeaders(true, $cache, $cacheKey, $mimeType);
            } else {
                $this->getHeaders(false, $cache, $cacheKey, $mimeType);
            }
        }
    }

    protected function _prepareImageFile($extension, $config)
    {

        $image = new Imagick($this->getFilePath());
        $image->setImageFormat($extension);

        \Iron_Utils_PngFix::process($image);

        if (isset($this->_currentProfile->negate)) {
            if ($this->_currentProfile->negate == 'yes') {
                $image->negateImage(0, 134217727);
            }
        }

        if (isset($this->_currentProfile->flop)) {
            if ($this->_currentProfile->flop == 'yes') {
                $image->flopImage();
            }
        }

        switch ($config['changeSize']) {
            case 'original':
                continue;
                break;

            case 'crop':
                \Iron_Imagick_Crop::init($image, $config);
                break;

            case 'resize':
                \Iron_Imagick_Resize::init($image, $config);
                break;

            case 'crop-resize':
                \Iron_Imagick_CropResize::init($image, $config);
                break;

            case 'resize-crop':
                \Iron_Imagick_ResizeCrop::init($image, $config);
                break;

            case 'scale':
                \Iron_Imagick_Scale::init($image, $config);
                break;

            case 'circle':
                \Iron_Imagick_Circle::init($image, $config);
                break;

            default:
                throw new Exception(
                    'El parametro "changeSize" invalido.'
                );
                break;
        }

        if (isset($this->_currentProfile->vignette)) {
            \Iron_Imagick_Vignette::init($image, $config['vignette']);
        }

        if (isset($this->_currentProfile->border)) {
            \Iron_Imagick_Border::init($image, $config['border']);
        }

        if (isset($this->_currentProfile->framing)) {
            \Iron_Imagick_Framing::init($image, $config['framing']);
        }

        if (isset($this->_currentProfile->compressionQuality)) {
            $image->setimagecompressionquality(
                $this->_currentProfile->compressionQuality
            );
        }

        return $image->getImagesBlob();
    }

    protected function _initParams()
    {

        $request = $this->_frontInstance->getRequest();

        $profile = $request->getParam(
            'profile',
            false
        );

        $routeMap = $request->getParam(
            'routeMap',
            false
        );

        $currentProfile = new stdClass();

        if (!$profile) {
            throw new Zend_Controller_Action_Exception(
                'Profile not defined',
                404
            );
        }

        if (!$routeMap) {
            throw new Zend_Controller_Action_Exception(
                'RouteMap not defined',
                404
            );
        }

        foreach ($this->_fsoConfig->$profile as $key => $val) {
            $currentProfile->$key = $val;
        }

        $this->_profileName = $profile;

        if (isset($currentProfile->extend)) {
            $extend = $currentProfile->extend;
            $profileExtend = $this->_fsoConfig->$extend;
            foreach ($profileExtend as $key => $val) {
                if (!isset($currentProfile->$key)) {
                    $currentProfile->$key = $val;
                }
            }
        }

        if (!isset($currentProfile->type)) {
            throw new Zend_Controller_Action_Exception(
                'Type not defined in profile',
                404
            );
        }

        $this->_profileType = $currentProfile->type;

        $this->_currentProfile = $currentProfile;
        if (!$currentProfile) {
            $this->_defaultImage();
        } elseif (isset($currentProfile->routeMap)) {
            $this->_routeMap = $currentProfile->routeMap;
        }



        $pattern = "/\{[^\}]+\}/";
        preg_match_all($pattern, $this->_routeMap, $resultados);
        $resultados = $resultados[0];

        $this->_routeMap = str_replace(
            $resultados,
            '#',
            $this->_routeMap
        );
        $this->_routeMap = array_values(
            array_filter(
                explode(
                    '#',
                    $this->_routeMap
                )
            )
        );

        $paramsResult = array();

        if (sizeof($this->_routeMap) > 0) {
            for ($i = 0; $i < sizeof($this->_routeMap); $i++) {
                $result = explode($this->_routeMap[$i], $routeMap, 2);
                $routeMap = $result[1];

                if ($i + 1 === sizeof($this->_routeMap)) {
                    $paramsResult[] = $result[0];
                    $paramsResult[] = $result[1];
                } else {
                    $paramsResult[] = $result[0];
                }
            }
        } else {
            $paramsResult[] = $routeMap;
        }

        $this->setFso(
            $currentProfile->fso
        );

        $where = $this->_prepareWhere(
            $resultados,
            $paramsResult,
            $currentProfile->model
        );
        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = Zend_Registry::get('data_gateway');
        $model = $dataGateway->findOneBy(
            $currentProfile->model,
            $where
        );

        if (!empty($model)) {
            $this->_model = $model;
        } else {
            $this->_defaultImage();
        }
    }

    protected function _setConfiguration($currentProfile)
    {

        $config = array();

        if ($currentProfile->type === 'binary') {
            return $config;
        }

        if (isset($currentProfile->changeSize)) {
            $config['changeSize'] = $currentProfile->changeSize;
        } else {
            throw new Exception(
                'El parametro "changeSize" es obligatorio.'
            );
        }

        if (isset($currentProfile->size)) {
            $config['size'] = $currentProfile->size * $this->getMultiplierRetina();
        }

        if (isset($currentProfile->width)) {
            $config['width'] = $currentProfile->width * $this->getMultiplierRetina();
        }

        if (isset($currentProfile->height)) {
            $config['height'] = $currentProfile->height * $this->getMultiplierRetina();
        }

        if (isset($currentProfile->vignette)) {
            $vignette = $currentProfile->vignette;

            $config['vignette'] = array();

            if (isset($vignette->blackPoint)) {
                $config['vignette']['blackPoint'] = $vignette->blackPoint;
            }
            if (isset($vignette->whitePoint)) {
                $config['vignette']['whitePoint'] = $vignette->whitePoint;
            }
            if (isset($vignette->x)) {
                $config['vignette']['x'] = $vignette->x;
            }
            if (isset($vignette->y)) {
                $config['vignette']['y'] = $vignette->y;
            }
        }

        if (isset($currentProfile->border)) {
            $border = $currentProfile->border;

            $config['border'] = array();

            if (isset($border->color)) {
                $config['border']['color'] = $border->color;
            }
            if (isset($border->width)) {
                $config['border']['width'] = $border->width;
            }
            if (isset($border->height)) {
                $config['border']['height'] = $border->height;
            }
        }

        if (isset($currentProfile->framing)) {
            $framing = $currentProfile->framing;

            $config['framing'] = array();

            if (isset($framing->color)) {
                $config['framing']['color'] = $framing->color;
            }

            if (isset($framing->width)) {
                $config['framing']['width'] = $framing->width;
            }

            if (isset($framing->height)) {
                $config['framing']['height'] = $framing->height;
            }

            if (isset($framing->innerBevel)) {
                $config['framing']['innerBevel'] = $framing->innerBevel;
            }

            if (isset($framing->outerBevel)) {
                $config['framing']['outerBevel'] = $framing->outerBevel;
            }
        }

        return $config;
    }

    /**
     * Crea o Carga los Headers para la cache
     * @param Boolena $isCache
     * @param Zend_Cache $cache
     * @param String $cacheKey
     */
    public function getHeaders($isCache, $cache, $cacheKey, $mimeType)
    {

        $response = $this->_frontInstance->getResponse();

        if ($isCache) {
            $response->setHttpResponseCode(304);
            $response->sendHeaders();
            return;
        }


        $expire = gmdate('D, d M Y H:i:s', time() + $this->_life);
        $modified = gmdate('D, d M Y H:i:s', time()).' GMT';

        $response->setHeader('Content-Disposition', 'inline; filename="'.$this->getBaseName().'"');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'public', true);
        $response->setHeader('Cache-control', 'max-age=' . 60*60*24*14, true);
        $response->setHeader('Expires', $expire .' GMT', true);
        $response->setHeader('Last-Modified', $modified, true);
        $response->setHeader('If-Modified-Since', $modified, true);
        $response->setHeader('ETag', $cacheKey, true);
        $response->setHeader('Content-Type', $mimeType, true);
        $response->setHeader('Content-transfer-encoding', 'binary', true);
        $response->sendHeaders();
        $response->setBody($cache->load($cacheKey));
    }

    /**
     * MimeType to Image
     * @param String $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * MimeType to Image
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Base name to Image
     * @param String $basename
     */
    public function setBasename($basename)
    {
        $this->basename = $basename;
        return $this;
    }

    /**
     * Base name to Image
     */
    public function getBasename()
    {
        return $this->basename;
    }

    /**
     * File path to Image
     * @param String $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * File path to Image
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Height to Image
     * @param String $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Height to Image
     */
    public function getHeight()
    {
        if (isset($this->height)) {
            return $this->height;
        } else {
            return null;
        }
    }

    /**
     * Width to Image
     * @param String $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Width to Image
     * @return String
     */
    public function getWidth()
    {
        if (isset($this->width)) {
            return $this->width;
        } else {
            return null;
        }
    }

    /**
     * FSO de la imagen que se quiere obtener
     * @param String $fso
     */
    public function setFso($fso)
    {
        $this->fso = $fso;
        return $this;
    }

    /**
     * FSO de la imagen que se quiere obtener
     * @return String
     */
    public function getFso()
    {
        return $this->fso;
    }

    /**
     * Multiplicador de tamaños de las imagenes
     * @param integer $x
     */
    public function setMultiplierRetina($x)
    {
        $this->_multiplierRetina = $x;
        return $this;
    }

    /**
     * Multiplicador de tamaños de las imagenes
     * @return integer
     */
    public function getMultiplierRetina()
    {
        return $this->_multiplierRetina;
    }

    protected function _getAvailableLangs()
    {
        $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $availableModelLangs = $bootstrap->getOption('modelLanguages');

        return array_keys($availableModelLangs);
    }

    /**
     * Prepare el where que buscara el modelo de de la imagen.
     * @param array $resultados
     * @param array $paramsResult
     * @param Object $model
     * @return array
     */
    protected function _prepareWhere($resultados, $paramsResult, $model)
    {
        $front = $this->_frontInstance
            ->getRouter()
            ->getFrontController();

        $availableLangs = $this->_getAvailableLangs();

        if (count($availableLangs) > 0) {
            $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');

            if (is_null($bootstrap)) {
                $conf = new \Zend_Config_Ini(
                    APPLICATION_PATH . '/configs/application.ini',
                    APPLICATION_ENV
                );
                $conf = (Object) $conf->toArray();
            } else {
                $conf = (Object) $bootstrap->getOptions();
            }

            if (isset($conf->translate['requestParam'])) {
                $langParam = $conf->translate['requestParam'];
            } else {
                /**
                 * Iron_Controller_Plugin_PublicTranslator
                 * DEFAULT_REQUEST_LANGUAGE_PARAM
                 */
                $langParam = 'language';
            }

            $lang = $front->getRequest()->getParam($langParam);

            if (is_null($lang)) {
                $request = $front->getRequest();
                $lang = $request->getCookie($langParam);
            }

            if (empty($lang)) {
                if (isset($conf->translate)) {
                    $lang = $conf->translate['defaultLanguage'];
                }
            }
        }

        $pieces = array();
        foreach ($resultados as $result) {
            $result = trim($result, '{');
            $pieces[] = trim($result, '}');
        }

        $where = [];
        $arguments = [];
        foreach ($pieces as $key => $piece) {
            if ($piece === 'basename') {
                $currentParamResult = $paramsResult[$key];
                $modelSegments = explode('\\', $model);
                $field = end($modelSegments) . '.' .  $this->getFso() . '.' . 'baseName';
                $where[] = $field . ' = :' . $this->getFso();
                $arguments[$this->getFso()] = $currentParamResult;
            } else {
                $currentParamResult = $paramsResult[$key];
                $modelSegments = explode('\\', $model);
                $field = end($modelSegments) . '.' .  $piece;
                $where[] = $field . ' = :' . $piece;
                $arguments[$piece] = $currentParamResult;
            }
        }

        return [
            implode(' AND ', $where),
            $arguments
        ];
    }

    /**
     * Crea una imagen por defecto cuando no hay errores.
     */
    protected function _defaultImage()
    {

        $image = new Imagick();
        $image->newImage(100, 100, new ImagickPixel('#F2F2F2'));
        $image->setImageFormat('png');

        header('Content-type: image/png');

        echo $image;
        die();
    }
}
