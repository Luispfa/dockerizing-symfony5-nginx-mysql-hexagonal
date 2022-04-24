<?php

namespace Tests\Domain\Score;

use App\Domain\Ad;
use App\Domain\Score\ScoreGarageComplete;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScoreGarageCompleteTest extends TestCase
{
    protected $ads, $pictures;

    protected function setUp(): void
    {
        $repository = new InFileSystemPersistence();
        $this->ads = $repository->getAds();
    }

    /**
     * @covers ScoreChaletComplete::__invoke
     **/
    public function testIsNotGarage()
    {
        $score = new ScoreGarageComplete($this->ads[2]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testHasPictures()
    {
        $score = new ScoreGarageComplete($this->ads[5]);
        $result = $score();

        $this->assertEquals(40, $result);
    }

    public function testHasNotPictures()
    {
        $score = new ScoreGarageComplete($this->ads[6]);
        $result = $score();

        $this->assertEquals(0, $result);
    }
}
