<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainingProposalLevels;



class TrainingProposalLevel extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'duration','registration_fees','training_fees',
        'training_capacity','description','training_proposal_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainingProposalLevels::table();
        parent::__construct($attributes);
    }
    
    public function trainingProposal(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingProposal','training_proposal_id');
    }
}