<?php

namespace App\Observers;

use App\Models\TaClass;

class ClassStudentObserver
{
    /**
     * Handle the Class "created" event.
     */
    public function created($model)
    {
        if ($model instanceof \Illuminate\Database\Eloquent\Relations\Pivot && $model->table === 'class_student') {
            $class = TaClass::find($model->class_id);
            if ($class) {
                $class->updateStudentsQuantity();
            }
        }
    }

    /**
     * Handle the Class "updated" event.
     */
    public function updated(TaClass $class): void
    {
        //
    }

    /**
     * Handle the Class "deleted" event.
     */
    public function deleted($model)
    {
        if ($model instanceof \Illuminate\Database\Eloquent\Relations\Pivot && $model->table === 'class_student') {
            $class = TaClass::find($model->class_id);
            if ($class) {
                $class->updateStudentsQuantity();
            }
        }
    }

    /**
     * Handle the Class "restored" event.
     */
    public function restored(TaClass $class): void
    {
        //
    }

    /**
     * Handle the Class "force deleted" event.
     */
    public function forceDeleted(TaClass $class): void
    {
        //
    }
}
