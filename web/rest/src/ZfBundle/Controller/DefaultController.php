<?php

namespace ZfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @author mainlycode
     * https://github.com/mainlycode/Zf1WrapperBundle
     */
    public function indexAction()
    {
        require_once 'Zend/Registry.php';

       // pass Dependency Injection Container
        \Zend_Registry::set('data_gateway', $this->container->get('zf.data_gateway'));
        $rootDir = $this->get('kernel')->getRootDir();

        // capture content from legacy application
        ob_start();
        include $rootDir . '/../../admin/public/zf.php';
        $content = ob_get_clean();

        // capture http response code
        if (function_exists('http_response_code') && http_response_code() > 0) {
            $code = http_response_code();
        } else {
            $code = 200;
        }

        // capture headers
        $headersSent = headers_list();
        $headers     = array();
        array_walk($headersSent, function($value, $key) use(&$headers) {
            $parts = explode(': ', $value);
            $headers[$parts[0]][] = $parts[1];
        });
        header_remove();

//        return $this->render('@Zf/Default/index.html.twig', array(
//            'content' => $content,
//        ));

        return new Response($content, $code, $headers);
    }
}
