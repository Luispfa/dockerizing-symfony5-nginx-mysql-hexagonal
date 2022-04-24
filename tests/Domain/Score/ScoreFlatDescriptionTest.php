<?php

namespace Tests\Domain\Score;

use App\Domain\Ad;
use App\Domain\Score\ScoreFlatDescription;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class ScoreFlatDescriptionTest extends TestCase
{
    protected $ads, $pictures;

    protected function setUp(): void
    {
        $repository = new InFileSystemPersistence();
        $this->ads = $repository->getAds();
    }

    public function testIsNotFlat()
    {
        $score = new ScoreFlatDescription($this->ads[0]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testLessThan20Words()
    {
        $score = new ScoreFlatDescription($this->ads[1]);
        $result = $score();

        $this->assertEquals(0, $result);
    }

    public function testLessThan50Words()
    {
        $ad = new Ad(2, 
        'FLAT',
         'Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo 
         Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo', 
         [4], 300, null, null, null);
        $score = new ScoreFlatDescription($ad);
        $result = $score();

        $this->assertEquals(10, $result);
    }

    public function testGreaterThan50Words()
    {
        $ad = new Ad(2, 
        'FLAT',
         'Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo 
         Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo 
         Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo 
         Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo', 
         [4], 300, null, null, null);
        $score = new ScoreFlatDescription($ad);
        $result = $score();

        $this->assertEquals(30, $result);
    }
}
