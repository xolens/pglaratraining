<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingProposalView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingProposalViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingProposalViewRepository extends AbstractReadableRepository implements TrainingProposalViewRepositoryContract
{
    public function model(){
        return TrainingProposalView::class;
    }
    
}
