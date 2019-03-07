<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainerHandicap;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainerHandicaps;

class TrainerHandicapRepository extends AbstractWritableRepository implements TrainerHandicapRepositoryContract
{
    public function model(){
        return TrainerHandicap::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $trainerId = self::get($data,'trainer_id');
        $handicapId = self::get($data,'handicap_id');
        $handicapYear = self::get($data,'handicap_year');
        return [
            'trainer_id' => ['required',Rule::unique(PgLaratrainingCreateTableTrainerHandicaps::table())->where(function ($query) use($id, $trainerId,$handicapId,$handicapYear) {
                return $query->where('id','!=', $id)
                ->where('trainer_id', $trainerId)
                ->where('handicap_id', $handicapId)
                ->where('handicap_year', $handicapYear);
            })
        ],];
    }
    
}
