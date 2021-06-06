<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    //protected $fillable= array('name', 'address', 'phone');

    public function speciality(){
        return $this->belongsTo(Especialidade::class);
    }
}
