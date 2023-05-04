<?php

    namespace Patienceman\CustomHandler\Console;

    use Illuminate\Console\Command;
    use Illuminate\Support\Str;

    class InstallHandlerCommand extends Command {
         /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'make:handler {name}';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Create your cutom handler class';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return int
         */
        public function handle() {
            $name = $this->argument('name');
            $dir = "./app/Handlers";
            $filename = $dir."/{$name}.php";

            if (!file_exists(dirname($filename)))
                mkdir(dirname($filename), 0777, true);

            fopen($filename, "w");

            $namespace = str_replace("/", "\\", Str::studly(
                dirname(str_replace(array("./"), "", $filename)
            )));

            $baseName = basename($filename, ".php");

            file_put_contents(
                $filename,
                $this->getFileInitialContents($namespace, $baseName)
            );

            $this->info("{$namespace}/{$baseName} created successfully");
        }

/**
 * Get file inital contents
 */
public function getFileInitialContents($namespace, $className) {
    return "<?php
    namespace $namespace;

    use Patienceman\CustomHandler\Handler;

    class {$className} extends Handler {
        /**
         * Custom execution from Handler Pipeline
         *
         * {$className} handler
         * @return void
         */
        public function execute() {
            // Whaever u want to handle inside this class
        }
    }
    ";
}
    }
