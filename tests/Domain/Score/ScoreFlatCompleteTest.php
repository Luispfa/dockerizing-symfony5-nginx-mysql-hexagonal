<?php

namespace Tests\Domain\Score;

use App\Domain\Ad;
use App\Domain\AdId;
use App\Domain\AdTypology;
use App\Domain\Score\ScoreFlatComplete;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScoreFlatCompleteTest extends TestCase
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
    public function testIsNotFlat()
    {
        $score = new ScoreFlatComplete($this->ads[2]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testIsNotCompleteHouseSizeZero()
    {
        $ad = new Ad(new AdId(5), new AdTypology('FLAT'), 'Pisazo,', [3, 8], 0, null, null, null);
        $score = new ScoreFlatComplete($ad);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testIsNotCompleteHouseSizeNull()
    {
        $ad = new Ad(new AdId(5), new AdTypology('FLAT'), 'Pisazo,', [3, 8], null, null, null, null);
        $score = new ScoreFlatComplete($ad);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    /**
     * @covers ScoreChaletComplete::__invoke
     **/
    public function testComplete()
    {
        $ad = new Ad(
            new AdId(9),
            new AdTypology('FLAT'),
            'Maravilloso chalet situado en las afueras de un pequeñoo pueblo rural. El entorno es espectacular, las vistas magníficas. cómprelo ahora!',
            [1, 7],
            300,
            150,
            null,
            null
        );
        $score = new ScoreFlatComplete($ad);
        $result = $score();

        $this->assertEquals(40, $result);
    }
}
