<?php

namespace App\Observers;

use App\Models\Partner;
use Illuminate\Support\Str;

class PartnerObserver
{
    public function creating(Partner $partner): void
    {
        $partner->slug = Str::slug(
            $partner->name
        );
    }

    /**
     * Handle the Partner "created" event.
     */
    public function created(Partner $partner): void
    {
        //
    }

    /**
     * Handle the Partner "updated" event.
     */
    public function updated(Partner $partner): void
    {
        if ($partner->isDirty('name')) {
            $partner->slug = Str::slug($partner->name);
        }
    }

    /**
     * Handle the Partner "deleted" event.
     */
    public function deleted(Partner $partner): void
    {
        //
    }

    /**
     * Handle the Partner "restored" event.
     */
    public function restored(Partner $partner): void
    {
        //
    }

    /**
     * Handle the Partner "force deleted" event.
     */
    public function forceDeleted(Partner $partner): void
    {
        //
    }
}
