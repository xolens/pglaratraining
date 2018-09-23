<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingProposalLevel;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingProposalLevelRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingProposalLevelRepository extends AbstractWritableRepository implements TrainingProposalLevelRepositoryContract
{
    public function model(){
        return TrainingProposalLevel::class;
    }
    
}
