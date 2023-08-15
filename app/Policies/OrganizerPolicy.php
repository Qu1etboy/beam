<?php

namespace App\Policies;

use App\Models\Organizer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrganizerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Organizer $organizer): bool
    {
        return true;
    }

    /**
     * Only owner of the organization can view the settings page.
     */
    public function viewSettings(User $user, Organizer $organizer): bool
    {
        return $user->id == $organizer->owner->id;
    }

    /**
     * Anyone can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Only owner of the organization can update the model.
     */
    public function update(User $user, Organizer $organizer): bool
    {
        return $user->id == $organizer->owner->id;
    }

    /**
     * Only owner of the organization can delete the model.
     */
    public function delete(User $user, Organizer $organizer): bool
    {
        return $user->id == $organizer->owner->id;
    }

    /**
     * Only owner of the organization can restore the model.
     */
    public function restore(User $user, Organizer $organizer): bool
    {
        return $user->id == $organizer->owner->id;
    }

    /**
     * Only owner of the organization can permanently delete the model.
     */
    public function forceDelete(User $user, Organizer $organizer): bool
    {
        return $user->id == $organizer->owner->id;
    }
}