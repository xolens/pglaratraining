<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentSubscription;
use Xolens\LaratrainingContract\App\Repository\Contract\StudentSubscriptionRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

class StudentSubscriptionRepository extends AbstractWritableRepository implements StudentSubscriptionRepositoryContract
{
    public function model(){
        return StudentSubscription::class;
    }
    
}
