<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainerDiseaseView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainerDiseaseViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainerDiseaseViewRepository extends AbstractReadableRepository implements TrainerDiseaseViewRepositoryContract
{
    public function model(){
        return TrainerDiseaseView::class;
    }
    
}
