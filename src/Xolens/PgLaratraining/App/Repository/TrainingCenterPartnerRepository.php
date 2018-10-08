<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingCenterPartner;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingCenterPartnerRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingCenterPartners;

class TrainingCenterPartnerRepository extends AbstractWritableRepository implements TrainingCenterPartnerRepositoryContract
{
    public function model(){
        return TrainingCenterPartner::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $name = self::get($data,'name');
        $trainingCenterId = self::get($data,'training_center_id');
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingCenterPartners::table())->where(function ($query) use($id, $name,$trainingCenterId) {
                return $query->where('id', '!=', $id)
                            ->where('name', $name)
                            ->where('training_center_id', $trainingCenterId);
            })],
            'training_center_id' => ['required'],
        ];
    }
    
    
}
