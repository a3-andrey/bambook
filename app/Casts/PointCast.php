<?php


namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PointCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     * @return void
     */
    public function get($model, $key, $value, $attributes)
    {
        $val = json_decode($value, true);
        return is_array($val) ? $val : [];
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     * @return void
     */
    public function set($model, $key, $value, $attributes)
    {
        $arr = explode(";", $value);
        return is_array($arr) ? json_encode($arr) : [];
    }
}
