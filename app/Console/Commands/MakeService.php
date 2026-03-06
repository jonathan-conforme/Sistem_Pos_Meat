<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $path = app_path("Services/{$name}.php");

        if (file_exists($path)) {
            $this->error('Service already exists!');
            return;
        }

        if (!is_dir(app_path('Services'))) {
            mkdir(app_path('Services'), 0755, true);
        }

        file_put_contents($path, $this->stub($name));

        $this->info("Service {$name} created successfully.");
    }

    protected function stub($name)
    {
        return <<<PHP
<?php

namespace App\Services;

class {$name}
{
    //
}
PHP;
    }
}
