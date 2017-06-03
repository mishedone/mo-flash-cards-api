<?php

namespace Tools;

use Phalcon\Http\Response;

/**
 * Factory of response objects.
 */
class ResponseFactory
{
    /**
     * Creates generic response object.
     *
     * @param int         $statusCode
     * @param string|null $content Default: null.
     * @return Response
     */
    protected function create($statusCode, $content = null)
    {
        $response = new Response();
        $response->setStatusCode($statusCode);
        if ($content) {
            $response->setJsonContent($content);
        }
        
        return $response;
    }
    
    /**
     * Creates a 404 response.
     *
     * @return Response
     */
    public function create404()
    {
        return $this->create(404);
    }
    
    /**
     * Creates a 500 response.
     *
     * @return Response
     */
    public function create500($error)
    {
        return $this->create(500, [
            'error' => $error
        ]);
    }
}