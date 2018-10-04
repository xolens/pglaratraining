<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\TrainingProposal;
use Xolens\LaratrainingContract\App\Repository\Contract\TrainingProposalRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainingProposals;

class TrainingProposalRepository extends AbstractWritableRepository implements TrainingProposalRepositoryContract
{
    public function model(){
        return TrainingProposal::class;
    }
    
    public function validationRules(array $data){
        $name = self::get($data,'name');
        $trainingCenterId = self::get($data,'training_center_id');
        return [
            'name' => ['required',Rule::unique(PgLaratrainingCreateTableTrainingProposals::table())->where(function ($query) use($name,$trainingCenterId) {
                return $query->where('name', $name)
                ->where('training_center_id', $trainingCenterId);
            })],
            'training_center_id' => ['required'],
        ];
    }
    
}
