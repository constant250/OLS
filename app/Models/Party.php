<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Party extends Model implements AuditableContract
{
    //
    use SoftDeletes;
    use Auditable;

    protected $table = 'party';

    protected $fillable = [
        'name', 'party_type_id'
    ];

    public function person()
    {
        return $this->hasOne(Person::class, 'party_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'party_id', 'id');
    }

}
