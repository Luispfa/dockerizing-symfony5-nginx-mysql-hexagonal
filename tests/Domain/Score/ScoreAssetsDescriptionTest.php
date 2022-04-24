<?php

namespace Tests\Domain\Score;

use App\Domain\Score\ScoreAssetsDescription;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScoreAssetsDescriptionTest extends TestCase
{
    protected $ads;

    protected function setUp(): void
    {
        $repository = new InFileSystemPersistence();
        $this->ads = $repository->getAds();
        $this->pictures = $repository->getPictures();
    }

    public function testZeroWords()
    {
        $score = new ScoreAssetsDescription($this->ads[0]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testFiveWords()
    {
        $score = new ScoreAssetsDescription($this->ads[1]);
        $result = $score();

        $this->assertEquals(25, $result);
    }
}
