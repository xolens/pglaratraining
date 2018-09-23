<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Disease;
use Xolens\LaratrainingContract\App\Repository\Contract\DiseaseRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class DiseaseRepository extends AbstractWritableRepository implements DiseaseRepositoryContract
{
    public function model(){
        return Disease::class;
    }
    
}
