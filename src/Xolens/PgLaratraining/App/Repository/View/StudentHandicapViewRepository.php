<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\StudentHandicapView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\StudentHandicapViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class StudentHandicapViewRepository extends AbstractReadableRepository implements StudentHandicapViewRepositoryContract
{
    public function model(){
        return StudentHandicapView::class;
    }
    
}
