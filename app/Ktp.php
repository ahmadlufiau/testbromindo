<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Ktp extends Model
{
    protected $table = 'ktp';

    protected $primaryKey = 'nik';

    public $incrementing = false;

    protected $fillable = [
        'nik', 'nama', 'tempatlahir', 'tanggallahir', 'jekel', 'alamat', 'agama', 'status', 'foto'
    ];

    // Umur
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['tanggallahir'])->age;
    }
}
