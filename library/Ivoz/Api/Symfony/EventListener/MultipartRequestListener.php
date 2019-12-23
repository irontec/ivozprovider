<?php

namespace Ivoz\Api\Symfony\EventListener;

use Ivoz\Api\Symfony\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Based on https://github.com/symfony/symfony/pull/10381/
*/
class MultipartRequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $isMultipart = 0 === strpos(
            $request->headers->get('CONTENT_TYPE'),
            'multipart/form-data'
        );

        if (!$isMultipart) {
            return;
        }

        $reqParams = $request->request->all();
        $isPutMethod = $request->isMethod('PUT');
        $isPostMethod = $request->isMethod('POST');
        if ($isPutMethod || empty($reqParams)) {
            $this->decodeMultiPartFormData($request);
        } elseif ($isPostMethod) {
            $this->setRequestContent(
                $request,
                end($reqParams)
            );
        }

        $request
            ->headers
            ->set('CONTENT_TYPE', 'application/json');
    }
    /**
     * This implementation is based on an example by netcoder at http://stackoverflow.com/a/9469615
     */
    protected function decodeMultiPartFormData(Request $request)
    {
        $files = array();
        $data = array();

        // Fetch content and determine boundary
        $rawData = $request->getContent();
        if ($rawData) {
            $contentType = $request->headers->get('CONTENT_TYPE');
            if (!preg_match('/boundary="?(.*)"?$/', $contentType, $matches)) {
                return;
            }

            // Fetch and process each part
            $parts = array_slice(explode($matches[1], $rawData), 1);
            foreach ($parts as $part) {
                // If this is the last part, break
                if ($part === "--\r\n") {
                    break;
                }
                // Separate content from headers
                $part = ltrim($part, "\r\n");
                list($rawHeaders, $content) = explode("\r\n\r\n", $part, 2);
                $content = substr($content, 0, strlen($content) - 2);
                // Parse the headers list
                $rawHeaders = explode("\r\n", $rawHeaders);
                $headers = array();
                foreach ($rawHeaders as $header) {
                    list($name, $value) = explode(':', $header, 2);
                    $headers[strtolower($name)] = ltrim($value, ' ');
                }
                // Parse the Content-Disposition to get the field name, etc.
                if (isset($headers['content-disposition'])) {
                    $filename = null;
                    preg_match(
                        '/^form-data; *name="([^"]+)"(?:; *filename="([^"]+)")?/',
                        $headers['content-disposition'],
                        $matches
                    );
                    $fieldName = $matches[1];
                    $fileName = ($matches[2] ?? null);
                    // If we have no filename, save the data. Otherwise, save the file.
                    if ($fileName === null) {
                        $data[$fieldName] = $content;
                    } else {
                        $localFileName = tempnam(sys_get_temp_dir(), 'sfy');
                        file_put_contents($localFileName, $content);
                        $files[$fieldName] = array(
                            'name' => $fileName,
                            'type' => $headers['content-type'],
                            'tmp_name' => $localFileName,
                            'error' => 0,
                            'size' => filesize($localFileName)
                        );
                        // Record the file path so that it can be verified as an uploaded file later
                        UploadedFile::$files[] = $localFileName;
                        // If the uploaded file is not moved, we need to delete it. To do that, we
                        // register a shutdown function to cleanup the temporary file
                        register_shutdown_function(function () use ($localFileName) {
                            @unlink($localFileName);
                        });
                    }
                }
            }
        }

        $request->files = new FileBag($files);
        $this->setRequestContent(
            $request,
            end($data)
        );
    }
    private function setRequestContent(Request $request, $data)
    {
        (function () use ($data) {
            $this->content = $data;
        })->call($request);
    }
}
