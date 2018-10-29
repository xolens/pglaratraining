<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingProposalLevelModule;
use Xolens\LaratrainingContract\App\Contract\Repository\TrainingProposalLevelModuleRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingProposalLevelModules;

class TrainingProposalLevelModuleRepository extends AbstractWritableRepository implements TrainingProposalLevelModuleRepositoryContract
{
    public function model(){
        return TrainingProposalLevelModule::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $trainingModuleId = self::get($data,'training_module_id');
        $trainingProposalLevelId = self::get($data,'training_proposal_level_id');
        return [
            'training_module_id' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingProposalLevelModules::table())->where(function ($query) use($id, $trainingModuleId,$trainingProposalLevelId) {
                return $query->where('id','!=', $id)
                ->where('training_module_id', $trainingModuleId)
                ->where('training_proposal_level_id', $trainingProposalLevelId);
            })
        ],];
    }
    
}
