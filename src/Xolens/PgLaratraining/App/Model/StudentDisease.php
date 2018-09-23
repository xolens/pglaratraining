<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableStudentDiseases;



class StudentDisease extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description','student_id','disease_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableStudentDiseases::table();
        parent::__construct($attributes);
    }

    public function disease(){
        return $this->belongsTo('PgLaratraining\App\Model\Disease','disease_id');
    } 

    public function student(){
        return $this->belongsTo('PgLaratraining\App\Model\Student','student_id');
    } 
}