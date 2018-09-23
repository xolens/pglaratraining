<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Scholarship;
use Xolens\LaratrainingContract\App\Repository\Contract\ScholarshipRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class ScholarshipRepository extends AbstractWritableRepository implements ScholarshipRepositoryContract
{
    public function model(){
        return Scholarship::class;
    }
    
}
