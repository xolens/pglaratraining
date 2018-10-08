<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainingCenterConventions;

class TrainingCenterConvention extends Model
{
    public const TRAINING_CENTER_PROPERTY = "training_center_id";
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','type','description','training_center_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainingCenterConventions::table();
        parent::__construct($attributes);
    }

    public function trainingCenter(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingCenter','training_center_id');
    } 
}