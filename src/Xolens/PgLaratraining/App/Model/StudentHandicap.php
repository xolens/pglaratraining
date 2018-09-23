<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableStudentHandicaps;



class StudentHandicap extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description','handicap_year','student_id','handicap_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableStudentHandicaps::table();
        parent::__construct($attributes);
    }

    public function handicap(){
        return $this->belongsTo('PgLaratraining\App\Model\Handicap','handicap_id');
    } 

    public function student(){
        return $this->belongsTo('PgLaratraining\App\Model\Student','student_id');
    } 
}