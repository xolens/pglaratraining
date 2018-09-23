<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingSpecialitie;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingSpecialitieRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingSpecialitieRepository extends AbstractWritableRepository implements TrainingSpecialitieRepositoryContract
{
    public function model(){
        return TrainingSpecialitie::class;
    }
    
}
