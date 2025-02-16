<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tugas', 'deadline', 'prioritas', 'status'];

    // Definisikan accessor untuk prioritas_text
    public function getPrioritasTextAttribute()
    {
        switch ($this->prioritas) {
            case 1:
                return 'High';
            case 2:
                return 'Medium';
            case 3:
                return 'Low';
            default:
                return 'Unknown';
        }
    }

    public function subTugas()
    {
        return $this->hasMany(SubTugas::class);
    }

    public function isPastDeadline()
    {
        return now()->greaterThan($this->deadline);
    }
}