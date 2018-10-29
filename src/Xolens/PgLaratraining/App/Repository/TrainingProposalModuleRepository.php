<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingProposalModule;
use Xolens\LaratrainingContract\App\Contract\Repository\TrainingProposalModuleRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingProposalModules;

class TrainingProposalModuleRepository extends AbstractWritableRepository implements TrainingProposalModuleRepositoryContract
{
    public function model(){
        return TrainingProposalModule::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $trainingModuleId = self::get($data,'training_module_id');
        $trainingProposalId = self::get($data,'training_proposal_id');
        return [
            'training_module_id' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingProposalModules::table())->where(function ($query) use($id, $trainingModuleId,$trainingProposalId) {
                return $query->where('id','!=', $id)
                ->where('training_module_id', $trainingModuleId)
                ->where('training_proposal_id', $trainingProposalId);
            })
        ],];
    }
    
}
