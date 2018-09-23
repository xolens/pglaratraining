<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainerDegree;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainerDegreeRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainerDegreeRepository extends AbstractWritableRepository implements TrainerDegreeRepositoryContract
{
    public function model(){
        return TrainerDegree::class;
    }
    
}
