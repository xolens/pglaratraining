<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\StudentView;
use Xolens\LaratrainingContract\App\Contract\Repository\View\StudentViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class StudentViewRepository extends AbstractReadableRepository implements StudentViewRepositoryContract
{
    public function model(){
        return StudentView::class;
    }
    
}
