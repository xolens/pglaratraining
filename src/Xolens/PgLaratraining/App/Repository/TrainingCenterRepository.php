<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingCenter;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingCenterRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingCenterRepository extends AbstractWritableRepository implements TrainingCenterRepositoryContract
{
    public function model(){
        return TrainingCenter::class;
    }
    
}
