<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingCenterView;
use Xolens\LaratrainingContract\App\Contract\Repository\View\TrainingCenterViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingCenterViewRepository extends AbstractReadableRepository implements TrainingCenterViewRepositoryContract
{
    public function model(){
        return TrainingCenterView::class;
    }
    
}
