<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingSpecialityView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingSpecialityViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingSpecialityViewRepository extends AbstractReadableRepository implements TrainingSpecialityViewRepositoryContract
{
    public function model(){
        return TrainingSpecialityView::class;
    }
    
}
