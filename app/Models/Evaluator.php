<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    use HasFactory;
    protected $table = 'evaluators';
    protected $primaryKey = 'evaluator_id';
    protected $fillable = ['evaluator_name', 'evaluator_login', 'evaluator_password', 'evaluator_preferences'];

    public function project() {
        return $this->belongsToMany(Project::class)->withPivot('evaluation_rating'); //3-5 projects
    }
}
