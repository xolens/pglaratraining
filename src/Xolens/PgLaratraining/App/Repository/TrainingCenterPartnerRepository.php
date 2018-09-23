<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingCenterPartner;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingCenterPartnerRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class TrainingCenterPartnerRepository extends AbstractWritableRepository implements TrainingCenterPartnerRepositoryContract
{
    public function model(){
        return TrainingCenterPartner::class;
    }
    
}
