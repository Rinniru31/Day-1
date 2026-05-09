<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use lluminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Dtabase\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    protected $table = 'employees'; //optional

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'birthday',
        'date_hired',
        'salary'
    ];

    public function department(): Belongsto
    {
        return $this->belongsto(Department::class, 'department_id');
    }

    public function projects():BelongstoMany
    {
        return$this ->belongsToMany(project::class,'employee_projects','employee_id','project_id');
    }
    
}