<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingModuleView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingModuleViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingModuleViewRepository extends AbstractReadableRepository implements TrainingModuleViewRepositoryContract
{
    public function model(){
        return TrainingModuleView::class;
    }
    
}
