<?php

namespace Tests\Domain\Score;

use App\Domain\Ad;
use App\Domain\Score\ScoreChaletComplete;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScoreChaletCompleteTest extends TestCase
{
    protected $ads, $pictures;

    protected function setUp(): void
    {
        $repository = new InFileSystemPersistence();
        $this->ads = $repository->getAds();
    }

    public function testIsNotChalet()
    {
        $score = new ScoreChaletComplete($this->ads[1]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testIsNotCompleteHouseSizeZero()
    {
        $ad = new Ad(5, 'CHALET', 'Pisazo,', [3, 8], 0, null, null, null);
        $score = new ScoreChaletComplete($ad);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testIsNotCompleteHouseSizeNull()
    {
        $ad = new Ad(5, 'CHALET', 'Pisazo,', [3, 8], NULL, null, null, null);
        $score = new ScoreChaletComplete($ad);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testComplete()
    {
        $ad = new Ad(
            9,
            'CHALET',
            'Maravilloso chalet situado en lAs afueras de un pequeñoo pueblo rural. El entorno es espectacular, las vistas magníficas. cómprelo ahora!',
            [1, 7],
            300,
            150,
            null,
            null
        );
        $score = new ScoreChaletComplete($ad);
        $result = $score();

        $this->assertEquals(40, $result);
    }
}
