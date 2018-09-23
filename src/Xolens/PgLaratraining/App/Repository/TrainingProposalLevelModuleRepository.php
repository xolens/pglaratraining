<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingProposalLevelModule;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingProposalLevelModuleRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingProposalLevelModuleRepository extends AbstractWritableRepository implements TrainingProposalLevelModuleRepositoryContract
{
    public function model(){
        return TrainingProposalLevelModule::class;
    }
    
}
