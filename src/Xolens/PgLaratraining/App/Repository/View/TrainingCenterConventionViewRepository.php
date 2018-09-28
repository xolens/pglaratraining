<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingCenterConventionView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingCenterConventionViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingCenterConventionViewRepository extends AbstractReadableRepository implements TrainingCenterConventionViewRepositoryContract
{
    public function model(){
        return TrainingCenterConventionView::class;
    }
    
}
