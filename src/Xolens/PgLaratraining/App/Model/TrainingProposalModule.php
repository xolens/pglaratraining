<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainingProposalModules;



class TrainingProposalModule extends Model
{
    public const TRAINER_PROPERTY = "trainer_id";
    public const TRAINING_PROPOSAL_PROPERTY = "training_proposal_id";
    public const TRAINING_MODULE_PROPERTY = "training_module_id";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','description',
        'trainer_id','training_proposal_id','training_module_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainingProposalModules::table();
        parent::__construct($attributes);
    }
    
    public function trainingProposal(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingProposal','training_proposal_id');
    }
}