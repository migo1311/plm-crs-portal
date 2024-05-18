<?php

namespace App\Observers;

use App\Models\Block;

class BlockStudentObserver
{
    /**
     * Handle the Block "created" event.
     */
    public function created(Block $block): void
    {
        //
    }

    /**
     * Handle the Block "updated" event.
     */
    public function updated(Block $block): void
    {
        //
    }

    /**
     * Handle the Block "deleted" event.
     */
    public function deleted(Block $block): void
    {
        //
    }

    /**
     * Handle the Block "restored" event.
     */
    public function restored(Block $block): void
    {
        //
    }

    /**
     * Handle the Block "force deleted" event.
     */
    public function forceDeleted(Block $block): void
    {
        //
    }
}
