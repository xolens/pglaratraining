<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\HandicapView;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class HandicapViewRepository extends AbstractReadableRepository implements HandicapViewRepositoryContract
{
    public function model(){
        return HandicapView::class;
    }
    
}
