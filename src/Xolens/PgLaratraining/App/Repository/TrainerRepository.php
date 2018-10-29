<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Trainer;
use Xolens\LaratrainingContract\App\Contract\Repository\TrainerRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainers;

class TrainerRepository extends AbstractWritableRepository implements TrainerRepositoryContract
{
    public function model(){
        return Trainer::class;
    }
    
    public function validationRules(array $data){
        return [
            'matricule' => [Rule::unique(PgLaratrainingCreateTableTrainers::table())->ignore(self::get($data,'id'), 'id')],
            'email' => ['required',Rule::unique(PgLaratrainingCreateTableTrainers::table())->ignore(self::get($data,'id'), 'id')],
            'phone1' => ['required',Rule::unique(PgLaratrainingCreateTableTrainers::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
