<?php

namespace Tests\Domain\Score;

use App\Domain\Ad;
use App\Domain\AdId;
use App\Domain\AdTypology;
use App\Domain\Score\ScoreChaletDescription;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScoreChaletDescriptionTest extends TestCase
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
    public function testIsNotChalet()
    {
        $score = new ScoreChaletDescription($this->ads[1]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    /**
     * @covers ScoreChaletComplete::__invoke
     **/
    public function testGreaterThan50Words()
    {
        $ad = new Ad(
            new AdId(8),
            new AdTypology('CHALET'),
              'Maravilloso chalet situado en las afueras de un pequeñoo pueblo rural. El entorno es espectacular, las vistas magníficas. cómprelo ahora!
              Maravilloso chalet situado en las afueras de un pequeñoo pueblo rural. El entorno es espectacular, las vistas magníficas. cómprelo ahora!
              Maravilloso chalet situado en las afueras de un pequeñoo pueblo rural. El entorno es espectacular, las vistas magníficas. cómprelo ahora!', 
              [1, 7], 300, null, null, null);
        $score = new ScoreChaletDescription($ad);
        $result = $score();

        $this->assertEquals(20, $result);
    }

    /**
     * @covers ScoreChaletComplete::__invoke
     **/
    public function testLessThan50Words()
    {
        $score = new ScoreChaletDescription($this->ads[7]);
        $result = $score();

        $this->assertEquals(0, $result);
    }
}
