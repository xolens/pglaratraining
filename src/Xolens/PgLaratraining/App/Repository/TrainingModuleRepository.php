<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingModule;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingModules;

class TrainingModuleRepository extends AbstractWritableRepository implements TrainingModuleRepositoryContract
{
    public function model(){
        return TrainingModule::class;
    }
    
    public function validationRules(array $data){
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingModules::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
