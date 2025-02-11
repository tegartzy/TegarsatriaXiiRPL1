<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTugas extends Model
{
    use HasFactory;

    protected $fillable = ['tugas_id', 'user_id', 'nama', 'status'];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}

