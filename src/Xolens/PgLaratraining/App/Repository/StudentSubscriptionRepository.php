<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\StudentSubscription;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateViewStudentSubscription;

class StudentSubscriptionRepository extends AbstractWritableRepository implements StudentSubscriptionRepositoryContract
{
    public function model(){
        return StudentSubscription::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $studentId = self::get($data,'student_id');
        $trainingProposalId = self::get($data,'training_proposal_id');
        return [
            'student_id' => ['required',Rule::unique(PgLaratrainingCreateViewStudentSubscription::table())->where(function ($query) use($id, $studentId,$trainingProposalId) {
                return $query->where('id','!=', $id)
                ->where('student_id', $studentId)
                ->where('training_proposal_id', $trainingProposalId);
            })
        ],];
    }
    
}
