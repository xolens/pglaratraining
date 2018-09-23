<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableStudentDegrees;



class StudentDegree extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','issued_institute','issued_date','training_degree_id','student_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableStudentDegrees::table();
        parent::__construct($attributes);
    }

    public function trainingDegree(){
        return $this->belongsTo('PgLaratraining\App\Model\TrainingDegree','training_degree_id');
    } 

    public function student(){
        return $this->belongsTo('PgLaratraining\App\Model\Student','student_id');
    } 
}