<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingSpeciality;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingSpecialityRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingSpecialityRepository extends AbstractWritableRepository implements TrainingSpecialityRepositoryContract
{
    public function model(){
        return TrainingSpeciality::class;
    }
    
}
