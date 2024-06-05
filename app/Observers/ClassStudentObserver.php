<?php

namespace App\Observers;

use App\Models\Classes;
use App\Models\TaClass;

class ClassStudentObserver
{
    /**
     * Handle the Class "created" event.
     */
    public function created($model)
    {
        if ($model instanceof \Illuminate\Database\Eloquent\Relations\Pivot && $model->table === 'class_student') {
            $class = Classes::find($model->id);
            if ($class) {
                $class->updateStudentsQuantity();
            }
        }
    }

    /**
     * Handle the Class "updated" event.
     */
    public function updated(Classes $class): void
    {
        //
    }

    /**
     * Handle the Class "deleted" event.
     */
    public function deleted($model)
    {
        if ($model instanceof \Illuminate\Database\Eloquent\Relations\Pivot && $model->table === 'class_student') {
            $class = Classes::find($model->class_id);
            if ($class) {
                $class->updateStudentsQuantity();
            }
        }
    }

    /**
     * Handle the Class "restored" event.
     */
    public function restored(Classes $class): void
    {
        //
    }

    /**
     * Handle the Class "force deleted" event.
     */
    public function forceDeleted(Classes $class): void
    {
        //
    }
}
