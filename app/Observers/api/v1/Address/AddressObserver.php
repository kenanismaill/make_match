<?php

namespace App\Observers\api\v1\Address;

use App\Models\Address;

class AddressObserver
{
    public function creating(Address $address): void
    {
        $result = app('geocoder')->geocode($address->fullAddress)->get();

        $coordinates = match (true) {
            $result->isNotEmpty() => $result[0]->getCoordinates(),
            default => null,
        };

        $address->latitude = $coordinates?->getLatitude();
        $address->longitude = $coordinates?->getLongitude();
    }
    /**
     * Handle the Address "created" event.
     */
    public function created(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "updated" event.
     */
    public function updated(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "deleted" event.
     */
    public function deleted(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "restored" event.
     */
    public function restored(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "force deleted" event.
     */
    public function forceDeleted(Address $address): void
    {
        //
    }
}
