<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait SanitizesTimestamps
{
    public static function bootSanitizesTimestamps(): void
    {
        static::creating(function ($model) {
            $model->created_at = $model->created_at?->setMicrosecond(0);
            $model->updated_at = $model->updated_at?->setMicrosecond(0);

            if (isset($model->expires_at)) {
                $model->expires_at = $model->expires_at?->setMicrosecond(0);
            }
        });

        static::updating(function ($model) {
            $model->updated_at = $model->updated_at?->setMicrosecond(0);

            if (isset($model->expires_at)) {
                $model->expires_at = $model->expires_at?->setMicrosecond(0);
            }
        });
    }
}
