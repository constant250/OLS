<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Person extends Model implements AuditableContract
{
    //
    use SoftDeletes;
    use Auditable;

    protected $table = 'person';

    protected $fillable = [
        'firstname', 'lastname', 'date_of_birth', 'prefix', 'gender'
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'id', 'party_id');
    }
}
