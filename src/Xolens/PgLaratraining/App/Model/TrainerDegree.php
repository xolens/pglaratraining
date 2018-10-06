<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainerDegrees;



class TrainerDegree extends Model
{
    public const TRAINER_PROPERTY = "trainer_id";
    public const TRAINING_DEGREE_PROPERTY = "training_degree_id";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','issued_institute','issued_date','training_degree_id','trainer_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainerDegrees::table();
        parent::__construct($attributes);
    }

    public function trainingDegree(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingDegree','training_degree_id');
    } 

    public function trainer(){
        return $this->belongsTo('PgLaratraining\App\Model\Trainer','trainer_id');
    } 
}