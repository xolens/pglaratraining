<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainerDegreeView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainerDegreeViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainerDegreeViewRepository extends AbstractReadableRepository implements TrainerDegreeViewRepositoryContract
{
    public function model(){
        return TrainerDegreeView::class;
    }
    
}
