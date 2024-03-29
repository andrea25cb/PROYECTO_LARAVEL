<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskClient extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $deleted = ['deleted_at'];

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'tlf',
        'direccion',
        'cp',
        'descripcion',
        'anotA',
        'anotP',
        'estadoTarea',
        'provincia',
        'poblacion',
        'fechaC',
        'fechaR',
        'clients_id',
    ];
    protected $dates = ['fechaC','fechaR'];
}
