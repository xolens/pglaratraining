<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingDegreeView;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingDegreeViewRepository extends AbstractReadableRepository implements TrainingDegreeViewRepositoryContract
{
    public function model(){
        return TrainingDegreeView::class;
    }
    
}
