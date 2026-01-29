<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'nilai_terbobot';
    protected $guarded =[];

    public function penilaian()
    {
        return $this->hasMany(Periode::class,'periode_id');
    }

    public function guru()
{
    return $this->belongsTo(Guru::class, 'guru_id');
}
}
