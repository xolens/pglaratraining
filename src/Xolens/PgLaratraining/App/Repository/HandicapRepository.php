<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Handicap;
use Xolens\LaratrainingContract\App\Repository\Contract\HandicapRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class HandicapRepository extends AbstractWritableRepository implements HandicapRepositoryContract
{
    public function model(){
        return Handicap::class;
    }
    
}
