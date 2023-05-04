<?php
    namespace Patienceman\CustomHandler;

    abstract class Handler {
        /**
         * Next interview processor
         * @var Handler $next
         */
        protected static Handler $next;

        /**
         * Execute the next pipeline CustomHandler
         *
         * @param Handler $CustomHandler
         * @return Handler
         */
        public static function handle(Handler $handler) {
            static::$next = $handler;
            static::$next->execute();
            return static::$next;
        }

        /**
         * Get all collected payloads
         *
         * @return Collection
         */
        public function collection() {
            return HandlerCollection::collection();
        }

        /**
         * Collect payload to be packed
         *
         * @param array $collection
         * @return HandlerCollection
         */
        public function collect(array $collection) {
            return HandlerCollection::collect($collection);
        }

        /**
         * Custom execution from pipine
         */
        abstract function execute();
    }
