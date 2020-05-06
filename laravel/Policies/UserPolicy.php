<?php

namespace App\Policies;

use App\User;

class UserPolicy
{
    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin() || $user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\User $user
     * @param string|null $targetType
     * @param int|null $targetId
     * @return mixed
     */
    public function viewAny(User $user, string $targetType, int $targetId)
    {
        return $user->role['target_type'] === $targetType && $user->role['target_id'] === $targetId;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->id === $model->id
            || ($user->role['target_type'] === $model->role['target_type']
                && $user->role['target_id'] === $model->role['target_id']
                && !in_array($user->role['name'], ['patient', 'caregiver']));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @param string|null $targetType
     * @param int|null $targetId
     * @return mixed
     */
    public function create(User $user, ?string $targetType = 'application', ?int $targetId = 0)
    {
        return $this->viewAny($user, $targetType, $targetId);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $this->view($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $this->view($user, $model);
    }

}
