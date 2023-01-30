<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $deleted = ['deleted_at'];

    protected $table = 'clients';

       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'tlf',
        'cuentaCorriente',
        'nif', 
        'pais',
        'moneda',
        'cuotaMensual',
    ];
}
