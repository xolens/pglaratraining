<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainerHandicaps;



class TrainerHandicap extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description','handicap_year','trainer_id','handicap_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainerHandicaps::table();
        parent::__construct($attributes);
    }
    
    public function handicap(){
        return $this->belongsTo('PgLaratraining\App\Model\Handicap','handicap_id');
    } 

    public function trainer(){
        return $this->belongsTo('PgLaratraining\App\Model\Trainer','trainer_id');
    }
}