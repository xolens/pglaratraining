<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentDisease;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableStudentDiseases;

class StudentDiseaseRepository extends AbstractWritableRepository implements StudentDiseaseRepositoryContract
{
    public function model(){
        return StudentDisease::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $studentId = self::get($data,'student_id');
        $diseaseId = self::get($data,'disease_id');
        return [
            'student_id' => ['required',Rule::unique(PgLaratrainingCreateTableStudentDiseases::table())->where(function ($query) use($id, $studentId, $diseaseId) {
                return $query->where('id','!=', $id)
                ->where('student_id', $studentId)
                ->where('disease_id', $diseaseId);
            })
        ],];
    }
    
}
