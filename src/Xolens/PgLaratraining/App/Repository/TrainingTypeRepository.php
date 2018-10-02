<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingType;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingTypeRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingTypes;

class TrainingTypeRepository extends AbstractWritableRepository implements TrainingTypeRepositoryContract
{
    public function model(){
        return TrainingType::class;
    }
    
    public function validationRules(array $data){
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingTypes::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
