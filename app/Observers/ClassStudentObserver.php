<?php

namespace App\Observers;

use App\Models\Classes;
use App\Models\Grade;

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

            // Create a new Grade record
            Grade::create([
                'student_no' => $model->student_no,
                'class_id' => $model->class_id,
                'grade' => null,
                'remarks' => "No grade yet",
                'completion_grade' => null, 
                'submitted_date' => null,
                'finalization_date' => null,
                'updated_by' => null,
            ]);
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
