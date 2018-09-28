<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\StudentSubscriptionView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\StudentSubscriptionViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class StudentSubscriptionViewRepository extends AbstractReadableRepository implements StudentSubscriptionViewRepositoryContract
{
    public function model(){
        return StudentSubscriptionView::class;
    }
    
}
