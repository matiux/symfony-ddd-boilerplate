<?php

declare(strict_types=1);

namespace Project\Common\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController
{
    public function index(): JsonResponse
    {
        return new JsonResponse(['response' => 'Hello World!']);
    }
}
