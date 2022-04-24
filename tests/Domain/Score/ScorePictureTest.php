<?php

namespace Tests\Domain\Score;

use App\Domain\Score\ScorePicture;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScorePictureTest extends TestCase
{
    protected $ads, $pictures;

    protected function setUp(): void
    {
        $repository = new InFileSystemPersistence();
        $this->ads = $repository->getAds();
        $this->pictures = $repository->getPictures();
    }

    public function testNotPictures()
    {
        $score = new ScorePicture($this->ads[0]);
        $result = $score($this->pictures);

        $this->assertEquals(-10, $result);
    }

    public function testOneHDPicture()
    {
        $score = new ScorePicture($this->ads[1]);
        $result = $score($this->pictures);

        $this->assertEquals(20, $result);
    }

    public function testOneSDPicture()
    {
        $score = new ScorePicture($this->ads[5]);
        $result = $score($this->pictures);

        $this->assertEquals(10, $result);
    }

    public function testTwoSDPicture()
    {
        $score = new ScorePicture($this->ads[7]);
        $result = $score($this->pictures);

        $this->assertEquals(20, $result);
    }

    public function testOneSDAndOneHDPictured()
    {
        $score = new ScorePicture($this->ads[4]);
        $result = $score($this->pictures);

        $this->assertEquals(30, $result);
    }
}
