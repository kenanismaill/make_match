<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SetUpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the project by running this command';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Define steps for project setup
        $steps = [
            'migrate:fresh' => 'Migrating database...',
            'db:seed' => 'Seeding database...',
            'passport:install' => 'Installing Passport...',
        ];

        $this->info("Starting project setup...");

        foreach ($steps as $step => $description) {
            $this->line("\n$description");
            try {
                $progressBar = $this->output->createProgressBar(1);
                Artisan::call($step);
                $this->info(Artisan::output());
            } catch (\Exception $e) {
                $this->error("Error occurred while running step '$step': " . $e->getMessage());
                continue;
            }

            $progressBar->finish();
            $this->line('');
        }

        $this->line("\n\nProject setup completed successfully!");

        return CommandAlias::SUCCESS;
    }
}
