<?php

namespace Xolens\PgLaratraining\App\Repository;

use Xolens\PgLaratraining\App\Model\Trainer;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;

use Illuminate\Validation\Rule;
use PgLaratrainingCreateTableTrainers;

class TrainerRepository extends AbstractWritableRepository implements TrainerRepositoryContract
{
    public function model(){
        return Trainer::class;
    }
    
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'matricule' => [Rule::unique(PgLaratrainingCreateTableTrainers::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id)
                ->WhereNotNull('matricule')
                ->Where('matricule','!=','');
            })],
            'email' => ['required',Rule::unique(PgLaratrainingCreateTableTrainers::table())->ignore($id, 'id')],
            'phone1' => ['required',Rule::unique(PgLaratrainingCreateTableTrainers::table())->ignore($id, 'id')],
        ];
    }
    
}
