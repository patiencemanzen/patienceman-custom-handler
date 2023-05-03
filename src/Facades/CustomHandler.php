<?php
    namespace Patienceman\Handler\Facades;

    use Illuminate\Support\Facades\Facade;

    class CustomHandler extends Facade {
        protected static function getFacadeAccessor(){
            return 'CustomHandler';
        }
    }
