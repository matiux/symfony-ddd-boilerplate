<?php

namespace BoundedContextToRename\Shared\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController
{
    public function index()
    {
        return new JsonResponse(['response' => 'Hello World!']);
    }
}
