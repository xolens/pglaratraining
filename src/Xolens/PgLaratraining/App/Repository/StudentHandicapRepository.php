<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentHandicap;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableStudentHandicaps;

class StudentHandicapRepository extends AbstractWritableRepository implements StudentHandicapRepositoryContract
{
    public function model(){
        return StudentHandicap::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $studentId = self::get($data,'student_id');
        $handicapId = self::get($data,'handicap_id');
        $handicapYear = self::get($data,'handicap_year');
        return [
            'student_id' => ['required',Rule::unique(PgLaratrainingCreateTableStudentHandicaps::table())->where(function ($query) use($id, $studentId,$handicapId,$handicapYear) {
                return $query->where('id','!=', $id)
                ->where('student_id', $studentId)
                ->where('handicap_id', $handicapId)
                ->where('handicap_year', $handicapYear);
            })
        ],];
    }
}
