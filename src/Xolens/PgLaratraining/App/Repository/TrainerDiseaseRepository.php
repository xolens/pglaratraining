<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainerDisease;
use Xolens\LaratrainingContract\App\Contract\Repository\TrainerDiseaseRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainerDiseases;

class TrainerDiseaseRepository extends AbstractWritableRepository implements TrainerDiseaseRepositoryContract
{
    public function model(){
        return TrainerDisease::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $trainerId = self::get($data,'trainer_id');
        $diseaseId = self::get($data,'disease_id');
        return [
            'trainer_id' => ['required',Rule::unique(PgLaratrainingCreateTableTrainerDiseases::table())->where(function ($query) use($id, $trainerId, $diseaseId) {
                return $query->where('id','!=', $id)
                ->where('trainer_id', $trainerId)
                ->where('disease_id', $diseaseId);
            })
        ],];
    }
    
}
