<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentHandicap;
use Xolens\LaratrainingContract\App\Repository\Contract\StudentHandicapRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class StudentHandicapRepository extends AbstractWritableRepository implements StudentHandicapRepositoryContract
{
    public function model(){
        return StudentHandicap::class;
    }
    
}
