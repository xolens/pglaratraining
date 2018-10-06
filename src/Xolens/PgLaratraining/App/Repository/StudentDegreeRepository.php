<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentDegree;
use Xolens\LaratrainingContract\App\Repository\Contract\StudentDegreeRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableStudentDegrees;

class StudentDegreeRepository extends AbstractWritableRepository implements StudentDegreeRepositoryContract
{
    public function model(){
        return StudentDegree::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $studentId = self::get($data,'student_id');
        $degreeId = self::get($data,'training_degree_id');
        return [
            'student_id' => ['required',Rule::unique(PgLaratrainingCreateTableStudentDegrees::table())->where(function ($query) use($id, $studentId, $degreeId) {
                return $query->where('id','!=', $id)
                ->where('student_id', $studentId)
                ->where('training_degree_id', $degreeId);
            })
        ],];
    }
    
}
