<?php

namespace App\Bootstrap;

use Illuminate\Foundation\Bootstrap\HandleExceptions as BaseHandleExceptions;
use Illuminate\Contracts\Foundation\Application;

class HandleExceptions extends BaseHandleExceptions
{
    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $this->app = $app;

        // Set error reporting to suppress deprecations
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

        // Register error handler that suppresses deprecations
        set_error_handler(function ($level, $message, $file = '', $line = 0, $context = []) {
            // Suppress deprecation notices
            if ($level === E_DEPRECATED || $level === E_USER_DEPRECATED) {
                return true;
            }

            // Otherwise, convert to ErrorException as Laravel normally does
            if (error_reporting() & $level) {
                throw new \ErrorException($message, 0, $level, $file, $line);
            }

            return false;
        });

        set_exception_handler([$this, 'handleException']);

        register_shutdown_function([$this, 'handleShutdown']);
    }
}
