<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $fillable = ['student_name', 'group_id'];

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
