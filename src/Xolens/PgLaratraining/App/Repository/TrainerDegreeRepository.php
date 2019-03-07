<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainerDegree;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainerDegrees;

class TrainerDegreeRepository extends AbstractWritableRepository implements TrainerDegreeRepositoryContract
{
    public function model(){
        return TrainerDegree::class;
    }

    public function validationRules(array $data){
        $id = self::get($data,'id');
        $trainerId = self::get($data,'trainer_id');
        $degreeId = self::get($data,'training_degree_id');
        return [
            'trainer_id' => ['required',Rule::unique(PgLaratrainingCreateTableTrainerDegrees::table())->where(function ($query) use($id, $trainerId, $degreeId) {
                return $query->where('id','!=', $id)
                ->where('trainer_id', $trainerId)
                ->where('training_degree_id', $degreeId);
            })
        ],];
    }
    
}
