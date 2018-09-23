<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentDegree;
use Xolens\LaratrainingContract\App\Repository\Contract\StudentDegreeRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class StudentDegreeRepository extends AbstractWritableRepository implements StudentDegreeRepositoryContract
{
    public function model(){
        return StudentDegree::class;
    }
    
}
