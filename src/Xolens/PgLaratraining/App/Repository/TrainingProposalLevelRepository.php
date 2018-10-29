<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingProposalLevel;
use Xolens\LaratrainingContract\App\Contract\Repository\TrainingProposalLevelRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingProposalLevels;

class TrainingProposalLevelRepository extends AbstractWritableRepository implements TrainingProposalLevelRepositoryContract
{
    public function model(){
        return TrainingProposalLevel::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $trainingProposalId = self::get($data,'training_proposal_id');
        $name = self::get($data,'name');
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingProposalLevels::table())->where(function ($query) use($id, $trainingProposalId, $name) {
                return $query->where('id','!=', $id)
                ->where('name', $name)
                ->where('training_proposal_id', $trainingProposalId);
            })
        ],];
    }
    
}
