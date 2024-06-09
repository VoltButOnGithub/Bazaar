<?php

use Tests\DuskTestCase;

function dusk(Closure $callback)
{
    $test = new class extends DuskTestCase
    {
        public function test(Closure $callback)
        {
            $this->browse($callback);
        }
    };

    test()->test($callback);
}
