<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingDegree;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingDegreeRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingDegreeRepository extends AbstractWritableRepository implements TrainingDegreeRepositoryContract
{
    public function model(){
        return TrainingDegree::class;
    }
    
}
