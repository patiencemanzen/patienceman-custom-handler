<?php

    namespace Patienceman\Handler;

    use Illuminate\Support\Collection;

    class HandlerCollection {
        /**
         * Payload that can be returned as response
         * @var mixed
         */
        public static array $payload = [];

        /**
         * Class constructor.
         */
        public static function collect(array $payload) {
            static::$payload = array_merge(static::$payload, $payload);
            return static::class;
        }

        /**
         * Get payload as response
         *
         * @return Collection
         */
        public static function collection() :Collection {
            return new Collection(static::$payload);
        }
    }
