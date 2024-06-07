<?php

namespace App\Console\Commands;

use App\Common\Enums\RoleType;
use App\Modules\User\Models\User;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_admin {email}';

    protected $description = 'Argument - email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('start command');
        $email = $this->argument('email');
        $user = User::query()
            ->where('email','=',$email)
            ->first();

        if ($user !== null) {
            $user->update([
                'role' => RoleType::Admin
            ]);
            $this->info("create admin - $email");
        }else{
            $this->info("the user was not found");
        }

    }
}
