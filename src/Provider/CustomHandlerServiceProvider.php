<?php

    namespace Patienceman\Customhandler\Provider;

    use Illuminate\Support\ServiceProvider;
    use Patienceman\Notifier\Console\InstallHandlerCommand;

    class CustomHandlerServiceProvider extends ServiceProvider {
        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot() {
            if ($this->app->runningInConsole())
                $this->commands([ InstallHandlerCommand::class ]);
        }
    }
