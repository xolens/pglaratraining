<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Student;
use Xolens\LaratrainingContract\App\Repository\Contract\StudentRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class StudentRepository extends AbstractWritableRepository implements StudentRepositoryContract
{
    public function model(){
        return Student::class;
    }
    
}
