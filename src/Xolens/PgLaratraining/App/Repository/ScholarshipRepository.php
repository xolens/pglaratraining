<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Scholarship;
use Xolens\LaratrainingContract\App\Repository\Contract\ScholarshipRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableScholarships;

class ScholarshipRepository extends AbstractWritableRepository implements ScholarshipRepositoryContract
{
    public function model(){
        return Scholarship::class;
    }
    
    public function validationRules(array $data){
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableScholarships::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
}
