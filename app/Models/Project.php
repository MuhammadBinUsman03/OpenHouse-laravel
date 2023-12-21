<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    protected $fillable = ['project_name', 'project_details', 'project_keywords', 'location_id'];

    public function evaluator() {
        return $this->belongsToMany(Evaluator::class,'evaluations','project_id','evaluator_id')->withPivot('evaluation_rating');
    }

    public function location() {
        return $this->hasOne(Location::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
