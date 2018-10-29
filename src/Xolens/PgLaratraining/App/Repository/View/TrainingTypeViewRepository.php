<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingTypeView;
use Xolens\LaratrainingContract\App\Contract\Repository\View\TrainingTypeViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingTypeViewRepository extends AbstractReadableRepository implements TrainingTypeViewRepositoryContract
{
    public function model(){
        return TrainingTypeView::class;
    }
    
}
