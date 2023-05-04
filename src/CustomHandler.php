<?php
    namespace Patienceman\CustomHandler;

    class CustomHandler {
        /**
         * Initialize and connect the Startup process pipes
         *
         * @param StartupService $process
         * @return StartupHandler
         */
        public static function handle(Handler $handler) {
            return $handler->handle($handler);
        }
    }
