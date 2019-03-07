<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\DiseaseView;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class DiseaseViewRepository extends AbstractReadableRepository implements DiseaseViewRepositoryContract
{
    public function model(){
        return DiseaseView::class;
    }
    
}
