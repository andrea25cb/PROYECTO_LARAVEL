<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuote extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $deleted = ['deleted_at'];
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cuotes';

    protected $fillable = [
        'concepto',
        'importe',
        'pagada',
        'fechaPago',
        'notas',
        'tasks_id',
      
    ];

}

