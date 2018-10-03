<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Student;
use Xolens\LaratrainingContract\App\Repository\Contract\StudentRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableStudents;

class StudentRepository extends AbstractWritableRepository implements StudentRepositoryContract
{
    public function model(){
        return Student::class;
    }
    
    public function validationRules(array $data){
        return [
            'matricule' => [Rule::unique(PgLaratrainingCreateTableStudents::table())->ignore(self::get($data,'id'), 'id')],
            'email' => ['required',Rule::unique(PgLaratrainingCreateTableStudents::table())->ignore(self::get($data,'id'), 'id')],
            'phone1' => ['required',Rule::unique(PgLaratrainingCreateTableStudents::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
