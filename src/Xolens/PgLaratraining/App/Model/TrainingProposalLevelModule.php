<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainingProposalLevelModules;



class TrainingProposalLevelModule extends Model
{
    public const TRAINER_PROPERTY = "trainer_id";
    public const TRAINING_PROPOSAL_LEVEL_PROPERTY = "training_proposal_level_id";
    public const TRAINING_MODULE_PROPERTY = "training_module_id";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','description',
        'trainer_id','training_proposal_level_id','training_module_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainingProposalLevelModules::table();
        parent::__construct($attributes);
    }
    
    public function trainingProposalLevel(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingProposalLevel','training_proposal_level_id');
    }
}