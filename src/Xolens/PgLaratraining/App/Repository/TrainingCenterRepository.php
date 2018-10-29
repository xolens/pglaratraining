<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingCenter;
use Xolens\LaratrainingContract\App\Contract\Repository\TrainingCenterRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingCenters;

class TrainingCenterRepository extends AbstractWritableRepository implements TrainingCenterRepositoryContract
{
    public function model(){
        return TrainingCenter::class;
    }
    
    public function validationRules(array $data){
        return [
            'matricule' => [Rule::unique(PgLaratrainingCreateTableTrainingCenters::table())->ignore(self::get($data,'id'), 'id')],
            'email' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingCenters::table())->ignore(self::get($data,'id'), 'id')],
            'phone1' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingCenters::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
