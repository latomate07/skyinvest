<?php 

use App\Models\User;

/**
 * Check if user is admin
 * @param int|null $id
 * @return bool
 */
function is_admin(?int $id)
{
    $user = User::find($id);
    return $user->role === "Administrator";
}

/**
 * Check if user is investor
 * @param int|null $id
 * @return bool
 */
function is_investor(?int $id)
{
    $user = User::find($id);
    return $user->role === "Investisseur";
}

/**
 * Check if user is entreprise
 * @param int|null $id
 * @return bool
 */
function is_entreprise(?int $id)
{
    $user = User::find($id);
    return $user->role === "Entreprise";
}