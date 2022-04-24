<?php

namespace Tests\Domain\Score;

use App\Domain\Score\ScoreDescription;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScoreDescriptionTest extends TestCase
{
    protected $ads;

    protected function setUp(): void
    {
        $repository = new InFileSystemPersistence();
        $this->ads = $repository->getAds();
    }

    public function testHasNotDescription()
    {
        $score = new ScoreDescription($this->ads[2]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testHasDescription()
    {
        $score = new ScoreDescription($this->ads[0]);
        $result = $score();

        $this->assertEquals(5, $result);
    }
}
