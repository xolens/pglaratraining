<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableStudentSubscriptions;



class StudentSubscription extends Model
{
    public const STUDENT_PROPERTY = "student_id";
    public const SCHOLARSHIP_PROPERTY = "scholarship_id";
    public const TRAINING_PROPOSAL_PROPERTY = "training_proposal_id";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','subscription_state','student_id','scholarship_id','training_proposal_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableStudentSubscriptions::table();
        parent::__construct($attributes);
    }
    
    public function scholarship(){
        return $this->belongsTo('PgLaratraining\App\Model\Scholarship','scholarship_id'); 
    }

    public function trainingProposal(){
        return $this->belongsTo('PgLaratraining\App\Model\Handicap','training_proposal_id');
    } 

    public function student(){
        return $this->belongsTo('PgLaratraining\App\Model\Student','student_id');
    } 
}