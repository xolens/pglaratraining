<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingDegree;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingDegreeRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingDegrees;

class TrainingDegreeRepository extends AbstractWritableRepository implements TrainingDegreeRepositoryContract
{
    public function model(){
        return TrainingDegree::class;
    }
    
    public function validationRules(array $data){
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingDegrees::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
