<?php
    use Oasis\Mapper\Sql as Mapper;
    use Oasis\Model as Model;


    if (isset($_SERVER['REMOTE_ADDR'])) {
    
    	die('Command Line Only!');
    }
    
    defined('__DIR__') || define('__DIR__', dirname(__FILE__));
    
    defined('APPLICATION_PATH') ||
    define('APPLICATION_PATH', realpath(__DIR__ . '/../'));
    
    // Ensure library/ is on include_path
    set_include_path(implode(PATH_SEPARATOR, array(
    '/opt/oasis/library',
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
    )));
    
    
    require_once 'Zend/Loader/Autoloader.php';
    $loader = Zend_Loader_Autoloader::getInstance();
    
    // we need this custom namespace to load our custom class
    $loader->registerNamespace('Iron_');
    
    // initialize values based on presence or absence of CLI options
    $env    = $_ENV['APPLICATION_ENV'];
    defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (null === $env) ? 'production' : $env);
    
    // initialize Zend_Application
    $application = new Zend_Application (
    		APPLICATION_ENV,
    		APPLICATION_PATH . '/configs/application.ini'
    );
    
    // bootstrap and retrive the frontController resource
    $front = $application->getBootstrap()
        ->bootstrap('frontController')
        ->getResource('frontController');
    
    // lets bootstrap our application and enjoy!
    $application->bootstrap();

    $faxMapper = new Mapper\FaxesInOut();
    $faxes = $faxMapper->findByField("status", "pending");


    // Login to AMI
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    $result = socket_connect($socket, "127.0.0.1", "5038");
    $in = "Action: Login\nusername: ironadmin\nsecret: adminsecret\nEvents: off\n\n";
    socket_write($socket, $in, strlen($in));

    // Foearch pending fax
    foreach ($faxes as $fax) {
        // Only Out faxes
        if ($fax->getType() != "Out")
            continue;

        // Convert PDF to TIFF file
        $faxPDF = $fax->fetchFile()->getFilePath();
        // Fax location is based on asterisk configuration
        $faxTIF = str_replace(".pdf", ".tif", $faxPDF);
        // Set destination file an fax options
        shell_exec("/usr/bin/gs -r400x400 -g3456x4676 -q -dNOPAUSE -dBATCH -sDEVICE=tiffg4 -sPAPERSIZE=a4 -sOutputFile=$faxTIF $faxPDF 2>&1 >/dev/null");

        // Get Fax data
        $faxDst =  $fax->getDst();
        $faxId = $fax->getId();

        // Login into AMI
        $in  = "Action: Originate\n";
        $in .= "Channel: Local/$faxDst@shared-faxout-dial\n";
        $in .= "Context: shared-faxout\n"; 
        $in .= "Exten: $faxDst\n";
        $in .= "Async: 1\n";
        $in .= "Variable: FAX_ID=$faxId,FAXFILE=$faxTIF\n";
        $in .= "\n";
        socket_write($socket, $in, strlen($in));
        sleep(1);
    }

    socket_close($socket);

