<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $primaryKey = 'id'; // Explicitly set primary key

    protected $fillable = [
        'name',
    ];

    public function attendants()
    {
        return $this->hasMany(Attendant::class, 'department_id', 'id');
    }
}