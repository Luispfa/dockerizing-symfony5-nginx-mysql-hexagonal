<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\CalculateScore;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CalculateScoreController
{
    private $calculate;

    public function __construct(CalculateScore $calculate)
    {
        $this->calculate = $calculate;
    }

    /**
     * @Route("/calculate-score", name="calculate-score")
     */
    public function calculateScore(): JsonResponse
    {
        return new JsonResponse($this->calculate->__invoke()->ads());
    }
}
