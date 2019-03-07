<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Student;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableStudents;

class StudentRepository extends AbstractWritableRepository implements StudentRepositoryContract
{
    public function model(){
        return Student::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $phone1 = self::get($data,'phone1');
        return [
            'matricule' => [Rule::unique(PgLaratrainingCreateTableStudents::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id)
                ->WhereNotNull('matricule')
                ->Where('matricule','!=','');
            })],
            'email' => ['required',Rule::unique(PgLaratrainingCreateTableStudents::table())->ignore(self::get($data,'id'), 'id')],
            'phone1' => ['required',Rule::unique(PgLaratrainingCreateTableStudents::table())->ignore(self::get($data,'id'), 'id')],
        ];
    }
    
}
