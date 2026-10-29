<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'department_id',
    ];

    public function department()
    {
        // Explicitly set foreign key 'department_id' and owner key 'id'
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}