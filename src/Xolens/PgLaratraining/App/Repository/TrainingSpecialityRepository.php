<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingSpeciality;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingSpecialities;

class TrainingSpecialityRepository extends AbstractWritableRepository implements TrainingSpecialityRepositoryContract
{
    public function model(){
        return TrainingSpeciality::class;
    }
    
    public function validationRules(array $data){
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingSpecialities::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
