<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\StudentDiseaseView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\StudentDiseaseViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class StudentDiseaseViewRepository extends AbstractReadableRepository implements StudentDiseaseViewRepositoryContract
{
    public function model(){
        return StudentDiseaseView::class;
    }
    
}
