<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'code',
        'name',
        'description'
    ];
    public function employees(): BelongsToMany
    {
        return $this->belongsToManay(Employee::class, 'employee_project','project_id","employee_id');
    }
}
