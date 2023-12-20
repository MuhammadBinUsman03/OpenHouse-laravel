<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    protected $fillable = ['group_login', 'group_password', 'project_id'];

    public function student() {
        return $this->hasMany(Student::class);
    }

    public function project() {
        return $this->hasOne(Project::class);
    }
}
