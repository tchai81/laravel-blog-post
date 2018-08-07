<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

class ApiServiceController extends Controller
{
    private $statusCode = 200;

    public function __construct($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Respond with not found message
     * @param  string $message
     * @return Response
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Respond with not authorized message
     * @param  string $message
     * @return Response
     */
    public function respondForbidden($message = 'Not Authorized!')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * [respondWithError description]
     * @param  String $message
     * @return Response
     */
    public function respondWithError($message)
    {
        return $this->respondWithJson([
            'message' => $message,
            'status_code' => $this->getStatusCode(),
        ]);
    }

    /**
     * Construct json structure to be returned
     * @param  array $data
     * @param  array  $headers
     * @return Response
     */
    public function respondWithJson($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode());
    }

    /**
     * Construct pagination structure to be returned
     * @param  Collection $data
     * @param  Transformer $transformer
     * @return Paginate
     */
    public function respondWithPagination($data, $transformer)
    {
        $paginate = $data->paginate();
        return $paginate->setCollection(collect($transformer->transformCollection($paginate->getCollection())));
    }
}
