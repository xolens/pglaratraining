<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingCenterPartnerView;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingCenterPartnerViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;

class TrainingCenterPartnerViewRepository extends AbstractReadableRepository implements TrainingCenterPartnerViewRepositoryContract
{
    public function model(){
        return TrainingCenterPartnerView::class;
    }
    
}
