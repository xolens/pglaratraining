<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainingModules;



class TrainingModule extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','description'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainingModules::table();
        parent::__construct($attributes);
    }

    public function trainingCenter(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingCenter','training_center_id');
    } 
}