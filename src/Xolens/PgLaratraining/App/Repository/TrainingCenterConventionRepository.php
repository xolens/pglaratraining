<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingCenterConvention;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingCenterConventionRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingCenterConventionRepository extends AbstractWritableRepository implements TrainingCenterConventionRepositoryContract
{
    public function model(){
        return TrainingCenterConvention::class;
    }
    
}
