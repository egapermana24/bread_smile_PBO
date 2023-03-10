<?php

namespace App\Policies;

use App\Models\Satuan;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class SatuanMassaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role == 'gudang' || $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Satuan $satuan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 'gudang' || $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Satuan $satuan)
    {
        return $user->role == 'gudang' || $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Satuan $satuan)
    {
        return $user->role == 'gudang' || $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Satuan $satuan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Satuan $satuan)
    {
        //
    }
}
