<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Start extends Command
{
    protected $signature = 'digichange:start';
    protected $description = 'Started command project';

    public function handle()
    {
        if (! app()->environment('local')) {
            $this->error('ARE YOU CRAZY? This is a development only command');

            return;
        }

        $this->warn('Schema Drop');
        Artisan::call('doctrine:schema:drop --force');
        $this->info(Artisan::output());

        $this->warn('Schema Update');
        Artisan::call('doctrine:schema:update');
        $this->info(Artisan::output());

        $this->warn('Create Admin Role');
        Artisan::call('blog:role:create Admin');
        $this->info(Artisan::output());

        $this->warn('Create Admin Role');
        Artisan::call('blog:role:create Editor');
        $this->info(Artisan::output());

        $this->warn('Create Admin User');
        Artisan::call('blog:user:create admin@blog.com --password=123456 --name=admin');
        $this->info(Artisan::output());

        $this->warn('Assign role to a user');
        Artisan::call('blog:assign:role:to:user admin@blog.com admin');
        $this->info(Artisan::output());

        $this->info('For additional configurations (Sentry, AWS), check the readme file');
    }
}
