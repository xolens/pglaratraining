<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Disease;
use Xolens\LaratrainingContract\App\Contract\Repository\DiseaseRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableDiseases;

class DiseaseRepository extends AbstractWritableRepository implements DiseaseRepositoryContract
{
    public function model(){
        return Disease::class;
    }
    
    public function validationRules(array $data){
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableDiseases::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
}
