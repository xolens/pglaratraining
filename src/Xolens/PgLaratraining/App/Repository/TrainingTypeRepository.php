<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingType;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingTypeRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingTypeRepository extends AbstractWritableRepository implements TrainingTypeRepositoryContract
{
    public function model(){
        return TrainingType::class;
    }
    
}
