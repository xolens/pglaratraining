<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainerView;
use Xolens\LaratrainingContract\App\Contract\Repository\View\TrainerViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainerViewRepository extends AbstractReadableRepository implements TrainerViewRepositoryContract
{
    public function model(){
        return TrainerView::class;
    }
    
}
