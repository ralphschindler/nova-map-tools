<?php

namespace RalphSchindler\NovaMapTools\Fields;

use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
// use LaravelEloquentSpatial\Types\Point;

class Coordinates extends Field
{
    public $component = 'coordinates-field';

    public $showOnIndex = true;

    // New Orleans: 30.004700348644185, -90.10802865028383
    public $meta = [
        'defaultCenter' => [
            'latitude'  => 30.004700348644185,
            'longitude' => -90.10802865028383,
        ],
    ];

    public function withType($type)
    {
        $this->withMeta([
            'coordinateType' => $type,
        ]);

        return $this;
    }

    public function withDefaultCenter($latitude, $longitude)
    {
        $this->withMeta(['defaultCenter' => [
            'latitude'  => $latitude,
            'longitude' => $longitude,
        ]]);

        return $this;
    }

    protected function resolveAttribute($resource, $attribute)
    {
        [$latitude, $longitude] = $resource->{$attribute}
            ? explode(',', str_replace(' ', '', $resource->{$attribute}), 2)
            : [null, null];

        return compact('latitude', 'longitude');
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $value = $request[$requestAttribute];

            if ($value) {
                $value = json_decode($value, true);
                $model->{$attribute} = "{$value['latitude']}, {$value['longitude']}";
            } else {
                $model->{$attribute} = null;
            }
        }
    }
}
