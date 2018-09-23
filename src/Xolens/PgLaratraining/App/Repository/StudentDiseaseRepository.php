<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentDisease;
use Xolens\LaratrainingContract\App\Repository\Contract\StudentDiseaseRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class StudentDiseaseRepository extends AbstractWritableRepository implements StudentDiseaseRepositoryContract
{
    public function model(){
        return StudentDisease::class;
    }
    
}
