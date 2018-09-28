<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingProposalLevelView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingProposalLevelViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingProposalLevelViewRepository extends AbstractReadableRepository implements TrainingProposalLevelViewRepositoryContract
{
    public function model(){
        return TrainingProposalLevelView::class;
    }
    
}
