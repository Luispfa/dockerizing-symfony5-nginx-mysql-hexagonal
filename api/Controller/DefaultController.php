<?php

declare(strict_types=1);

namespace Api\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class DefaultController
{

    /**
     * @Route("/", name="")
     */
    public function default(): JsonResponse
    {
        return new JsonResponse(['hola mundo']);
    }
}