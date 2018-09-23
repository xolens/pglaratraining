<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingProposal;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingProposalRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingProposalRepository extends AbstractWritableRepository implements TrainingProposalRepositoryContract
{
    public function model(){
        return TrainingProposal::class;
    }
    
}
