<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableStudents;
use Xolens\LarautilContract\App\Util\Format\Formater;



class Student extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','matricule','email','name','gender',
        'birth_date','birth_place','phone1','phone2',
        'person_to_contact','person_to_contact_description','person_to_contact_phone_1',
        'person_to_contact_phone_2','description',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableStudents::table();
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->phone1 = Formater::formatPhone($model->phone1);
            $model->phone2 = Formater::formatPhone($model->phone2);
            $model->person_to_contact_phone_1 = Formater::formatPhone($model->person_to_contact_phone_1);
            $model->person_to_contact_phone_2 = Formater::formatPhone($model->person_to_contact_phone_2);
        });
        
        self::updating(function($model){
            $model->phone1 = Formater::formatPhone($model->phone1);
            $model->phone2 = Formater::formatPhone($model->phone2);
            $model->person_to_contact_phone_1 = Formater::formatPhone($model->person_to_contact_phone_1);
            $model->person_to_contact_phone_2 = Formater::formatPhone($model->person_to_contact_phone_2);
        });
    }
}