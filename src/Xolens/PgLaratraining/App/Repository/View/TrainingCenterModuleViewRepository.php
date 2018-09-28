<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingCenterModuleView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingCenterModuleViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingCenterModuleViewRepository extends AbstractReadableRepository implements TrainingCenterModuleViewRepositoryContract
{
    public function model(){
        return TrainingCenterModuleView::class;
    }
    
}
