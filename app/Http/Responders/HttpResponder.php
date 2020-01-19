<?php

namespace App\Http\Responders;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;

class HttpResponder
{
    /** @var Factory */
    private $viewFactory;
    /** @var Response */
    private $response;

    public function __construct(Factory $viewFactory, Response $response)
    {
        $this->viewFactory = $viewFactory;
        $this->response = $response;
    }

    public function success(string $view, array $data = [], int $status = 200)
    {
        $output = $this->viewFactory->make($view, $data);

        return $this->response->setContent($output)->setStatusCode($status);
    }

    public function error(string $view, int $status = 500, array $data = [])
    {
        $output = $this->viewFactory->make($view, $data);

        return $this->response->setContent($output)->setStatusCode($status);
    }
}
