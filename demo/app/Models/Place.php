<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    use HasFactory;
    use HasUlids;

    // protected static function boot()
    // {
    //     static::addGlobalScope('coordinates_as_json', function (Builder $builder) {
    //         $builder->addSelect(['*', DB::raw('ST_AsGeoJSON(coordinates) as coordinates')]);
    //     });
    //
    //     parent::boot();
    // }
}
