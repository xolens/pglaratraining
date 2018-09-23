<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingCenterModule;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingCenterModuleRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingCenterModuleRepository extends AbstractWritableRepository implements TrainingCenterModuleRepositoryContract
{
    public function model(){
        return TrainingCenterModule::class;
    }
    
}
