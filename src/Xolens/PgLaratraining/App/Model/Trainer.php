<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use Xolens\LarautilContract\App\Util\Format\Formater;
use PgLaratrainingCreateTableTrainers;


class Trainer extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','matricule','email','name',
        'gender','birth_date','birth_place',
        'phone1','phone2','description',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainers::table();
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->phone1 = Formater::formatPhone($model->phone1);
            $model->phone2 = Formater::formatPhone($model->phone2);
        });
        
        self::updating(function($model){
            $model->phone1 = Formater::formatPhone($model->phone1);
            $model->phone2 = Formater::formatPhone($model->phone2);
        });
    }

    
}