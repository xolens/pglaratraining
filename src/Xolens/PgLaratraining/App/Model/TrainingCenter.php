<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

use PgLaratrainingCreateTableTrainingCenters;
use Xolens\LarautilContract\App\Util\Format\Formater;

class TrainingCenter extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','matricule','email','name',
        'sigle','mailbox_number','mailbox_city',
        'phone1','phone2','website',
        'creation_year','creation_order_number','creation_order_date',
        'opening_year','promoter_name','promoter_gender',
        'local_array','local_title','local_property',
        'manager_name','center_type','center_order',
        'approval_date','approval_order_number','description',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaratrainingCreateTableTrainingCenters::table();
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