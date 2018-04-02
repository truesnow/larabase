<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*
     * 用户只能更新自己的个人信息
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /*
     * 只有超级管理员具有删除用户的权限，且不能删除自己
     */
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id != $user->id;
    }
}
