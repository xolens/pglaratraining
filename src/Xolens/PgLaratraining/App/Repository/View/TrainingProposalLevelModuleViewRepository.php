<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingProposalLevelModuleView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingProposalLevelModuleViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingProposalLevelModuleViewRepository extends AbstractReadableRepository implements TrainingProposalLevelModuleViewRepositoryContract
{
    public function model(){
        return TrainingProposalLevelModuleView::class;
    }
    
}
