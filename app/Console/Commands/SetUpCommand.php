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

        // Display initial message
        $this->info("Starting project setup...");

        // Initialize progress bar
        $progressBar = $this->output->createProgressBar(count($steps));

        foreach ($steps as $step => $description) {
            // Display current step description
            $this->line("\n$description");

            try {
                // Execute current step
                Artisan::call($step);
                // Display output of the command
                $this->info(Artisan::output());
            } catch (\Exception $e) {
                // Handle errors if any
                $this->error("Error occurred while running step '$step': " . $e->getMessage());
            }

            // Advance progress bar
            $progressBar->advance();
        }

        // Finish progress bar
        $progressBar->finish();

        // Display completion message
        $this->line("\n\nProject setup completed successfully!");

        return CommandAlias::SUCCESS;
    }
}
