<?php

namespace App\Console;


use EsperoSoft\Artisan\Console\Commands\MakeCrudCommand;
use EsperoSoft\Artisan\Console\Commands\MakeEntityCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');


        #enregistrer les commandes makeEntities
        $this->getArtisan()->add( new MakeEntityCommand() );
        #enregistrer les commandes makecrud
        $this->getArtisan()->add( new MakeCrudCommand() );

        require base_path('routes/console.php');
    }
}
