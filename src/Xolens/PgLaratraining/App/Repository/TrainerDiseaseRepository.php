<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainerDisease;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainerDiseaseRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainerDiseaseRepository extends AbstractWritableRepository implements TrainerDiseaseRepositoryContract
{
    public function model(){
        return TrainerDisease::class;
    }
    
}
