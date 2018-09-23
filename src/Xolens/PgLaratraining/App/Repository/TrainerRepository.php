<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Trainer;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainerRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainerRepository extends AbstractWritableRepository implements TrainerRepositoryContract
{
    public function model(){
        return Trainer::class;
    }
    
}
