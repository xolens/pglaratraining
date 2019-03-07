<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Handicap;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableHandicaps;

class HandicapRepository extends AbstractWritableRepository implements HandicapRepositoryContract
{
    public function model(){
        return Handicap::class;
    }
    
    public function validationRules(array $data){
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableHandicaps::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
}
