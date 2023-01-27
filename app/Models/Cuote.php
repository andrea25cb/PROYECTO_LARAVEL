<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuote extends Model
{
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

