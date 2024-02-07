<?php

namespace Modules\People\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Branch\Entities\Branch;

class Customer extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected static function newFactory() {
        return \Modules\People\Database\factories\CustomerFactory::new();
    }

    public function getBranchAttribute()
    {
        return Branch::find($this->branch_id)?->name ?? 'NA';
    }
}
