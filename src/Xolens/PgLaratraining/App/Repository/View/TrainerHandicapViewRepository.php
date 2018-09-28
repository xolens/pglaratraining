<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainerHandicapView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainerHandicapViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainerHandicapViewRepository extends AbstractReadableRepository implements TrainerHandicapViewRepositoryContract
{
    public function model(){
        return TrainerHandicapView::class;
    }
    
}
