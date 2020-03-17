<?php

namespace Project\Common\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController
{
    public function index()
    {
        return new JsonResponse(['response' => 'Hello World!']);
    }
}
