<?php

namespace Xolens\PgLaratraining\App\Model;

use Illuminate\Database\Eloquent\Model;

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
}