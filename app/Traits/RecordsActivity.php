<?php

namespace App\Traits;

use App\Activity;
use ReflectionClass;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;

        foreach (static::getEventsToRecord() as $event) {
            static::$event(function ($model) {
                $model->recordActivity('created');
            });
        }
    }

    protected static function getEventsToRecord()
    {
        return ['created'];
    }

    public function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => "{$event}_{$this->getTypeName()}",
        ]);
    }

    protected function getTypeName()
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
