<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\ScholarshipView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\ScholarshipViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class ScholarshipViewRepository extends AbstractReadableRepository implements ScholarshipViewRepositoryContract
{
    public function model(){
        return ScholarshipView::class;
    }
    
}
