<?php

namespace App\Console\Commands;

use App\Mail\AdminCreatedMail;
use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GenerateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-admin {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a filament admin with random password.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = Str::password(16);

        Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        /** @var string[] $emails */
        $emails = config('filament.trusted_emails');

        Mail::to(Arr::first($emails))
            ->send(new AdminCreatedMail($email, $password));

        $this->info("Admin {$name} created successfully.");

        return CommandAlias::SUCCESS;
    }
}
