<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
class UserObserver
{

    public function created(User $user): void
    {
        
         Log::info('User created', [
        'email' => $user->email,
        'id' => $user->id
    ]);
    }


  public function updated(User $user)
{
    Log::info('User updated', [
        'id' => $user->id,
        'changed_fields' => array_keys($user->getChanges()),
    ]);
}

    public function deleted(User $user): void
{
    Log::warning('User deleted from system', [
        'user_id' => $user->id,
        'email' => $user->email,
       'deleted_by' => [
    'id' => auth()->id(),
    'name' => auth()->user()?->name,
]
    ]);
}

}
