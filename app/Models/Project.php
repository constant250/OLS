<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Project extends Model implements AuditableContract
{
    //
    use SoftDeletes;
    use Auditable;

    protected $fillable = [
        'name', 'project_type_id', 'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project_type()
    {
        return $this->belongsTo(ProjectType::class);
    }

}
