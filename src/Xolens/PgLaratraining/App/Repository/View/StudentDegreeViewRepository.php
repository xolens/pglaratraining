<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\StudentDegreeView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\StudentDegreeViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class StudentDegreeViewRepository extends AbstractReadableRepository implements StudentDegreeViewRepositoryContract
{
    public function model(){
        return StudentDegreeView::class;
    }
    
}
