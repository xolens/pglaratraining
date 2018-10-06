<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainingProposals;



class TrainingProposal extends Model
{
    public const TRAINING_CENTER_PROPERTY = "training_center_id";
    public const TRAINING_SPECIALITY_PROPERTY = "training_speciality_id";
    public const TRAINING_TYPE_PROPERTY = "training_type_id";
    public const TRAINING_DEGREE_PROPERTY = "training_degree_id";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','year', 'total_fees',
        'total_duration','description','training_center_id',
        'training_speciality_id','training_type_id','training_degree_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainingProposals::table();
        parent::__construct($attributes);
    }
    
    public function trainingCenter(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingCenter','training_center_id');
    }
    
    public function trainingSpeciality(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingSpeciality','training_speciality_id');
    }
    
    public function trainingType(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingType','training_type_id');
    }
    
    public function trainingDegree(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingDegree','training_degree_id');
    }
}