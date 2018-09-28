<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingModule;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingModuleRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingModuleRepository extends AbstractWritableRepository implements TrainingModuleRepositoryContract
{
    public function model(){
        return TrainingModule::class;
    }
    
}
