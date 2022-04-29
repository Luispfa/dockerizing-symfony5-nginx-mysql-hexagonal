<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Ad;
use App\Domain\AdId;
use App\Domain\AdTypology;
use App\Domain\Picture;
use App\Domain\SystemPersistenceRepository;
use function Lambdish\Phunctional\search as PhunctionalSearch;

final class InFileSystemPersistence implements SystemPersistenceRepository
{
    private $ads = [];
    private $pictures = [];

    public function __construct()
    {
        array_push($this->ads, new Ad(new AdId(1), new AdTypology('CHALET'), 'Este piso es una ganga, compra, compra, COMPRA!!!!! Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, 150, null, null));
        array_push($this->ads, new Ad(new AdId(2), new AdTypology('FLAT'), 'Nuevo Ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este Ático de lujo', [4], 300, null, null, null));
        array_push($this->ads, new Ad(new AdId(3), new AdTypology('CHALET'), '', [2], 300, null, null, null));
        array_push($this->ads, new Ad(new AdId(4), new AdTypology('FLAT'), 'Ático cèntrico muy luminoso y recién reformado, parece nuevo', [5], 300, null, null, null));
        array_push($this->ads, new Ad(new AdId(5), new AdTypology('FLAT'), 'Pisazo,', [3, 8], 300, null, null, null));
        array_push($this->ads, new Ad(new AdId(6), new AdTypology('GARAGE'), '', [6], 300, null, null, null));
        array_push($this->ads, new Ad(new AdId(7), new AdTypology('GARAGE'), 'Garaje en el centro de Albacete', [], 300, null, null, null));
        array_push($this->ads, new Ad(new AdId(8), new AdTypology('CHALET'), 'Maravilloso chalet situado en las afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. cómprelo ahora!', [1, 7], 300, null, null, null));

        array_push($this->pictures, new Picture(1, 'https://www.idealista.com/pictures/1', 'SD'));
        array_push($this->pictures, new Picture(2, 'https://www.idealista.com/pictures/2', 'HD'));
        array_push($this->pictures, new Picture(3, 'https://www.idealista.com/pictures/3', 'SD'));
        array_push($this->pictures, new Picture(4, 'https://www.idealista.com/pictures/4', 'HD'));
        array_push($this->pictures, new Picture(5, 'https://www.idealista.com/pictures/5', 'SD'));
        array_push($this->pictures, new Picture(6, 'https://www.idealista.com/pictures/6', 'SD'));
        array_push($this->pictures, new Picture(7, 'https://www.idealista.com/pictures/7', 'SD'));
        array_push($this->pictures, new Picture(8, 'https://www.idealista.com/pictures/8', 'HD'));
    }

    public function getAds(): array
    {
        return $this->ads;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function searchAd(AdId $id): Ad
    {
        return PhunctionalSearch(
            function (Ad $ad) use ($id) {
                return $ad->getId() == $id;
            },
            $this->ads
        );
    }
}
