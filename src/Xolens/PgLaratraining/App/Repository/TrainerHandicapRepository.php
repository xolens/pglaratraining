<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainerHandicap;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainerHandicapRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainerHandicapRepository extends AbstractWritableRepository implements TrainerHandicapRepositoryContract
{
    public function model(){
        return TrainerHandicap::class;
    }
    
}
