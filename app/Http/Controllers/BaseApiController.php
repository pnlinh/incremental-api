<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class BaseApiController extends Controller
{
    private $statusCode = Response::HTTP_OK;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function responseNotFound($message = 'Not found.')
    {
        return $this
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    public function responseInternalError($message = 'Internal Error !')
    {
        return $this
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
    }

    public function respond($data, $headers = [])
    {
        return \response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode(),
            ],
        ]);
    }
}
