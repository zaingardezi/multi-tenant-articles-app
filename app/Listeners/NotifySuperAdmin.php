<?php
namespace App\Listeners;

use App\Models\User;
use App\Notifications\superAdminNotification;

class NotifySuperAdmin
{
    public function handle($event): void
    {
        
        $superAdmins = User::role('superadmin')->get();

        foreach ($superAdmins as $superAdmin) {
            $superAdmin->notify(new superAdminNotification($event));
        }
     }
}