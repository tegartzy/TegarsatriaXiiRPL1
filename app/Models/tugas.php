<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tugas', 'deadline', 'prioritas', 'status'];

    public function subTugas()
    {
        return $this->hasMany(SubTugas::class);
    }

    public function isPastDeadline()
    {
        return now()->greaterThan($this->deadline);
    }
}