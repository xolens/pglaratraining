<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainerDiseases;



class TrainerDisease extends Model
{
    public const TRAINER_PROPERTY = "trainer_id";
    public const DISEASE_PROPERTY = "disease_id";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description','trainer_id','disease_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainerDiseases::table();
        parent::__construct($attributes);
    }

    public function disease(){
        return $this->belongsTo('PgLaratraining\App\Model\Disease','disease_id');
    } 

    public function trainer(){
        return $this->belongsTo('PgLaratraining\App\Model\Trainer','trainer_id');
    } 
}