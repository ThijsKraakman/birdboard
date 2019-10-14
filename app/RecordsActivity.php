<?php

namespace App;

use Illuminate\Support\Arr;

trait RecordsActivity
{
    public $old = [];

    public static function bootRecordsActivity() 
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                $model->old = $model->getOriginal();
            });
        }    
    }   
}

    protected function activityDescription($description) 
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    protected static function recordableEvents()
    {
        if(isset(static::$recordableEvents)) {
            return $recordableEvents = static::$recordableEvents;
        } else {
            return ['created', 'updated', 'deleted'];
        }
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id,
            'changes' => $this->activityChanges(),
            'description' => $description
        ]);
    }  

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    public function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at')
            ];
        }
    }
}