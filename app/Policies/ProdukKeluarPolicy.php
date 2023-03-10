<?php

namespace App\Policies;

use App\Models\ProdukKeluar;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProdukKeluarPolicy
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
        return $user->role == 'distribusi' || $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProdukKeluar $produkKeluar)
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
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProdukKeluar $produkKeluar)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProdukKeluar $produkKeluar)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProdukKeluar $produkKeluar)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProdukKeluar $produkKeluar)
    {
        //
    }
}
