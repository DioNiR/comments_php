<?php

namespace app\core;

class View
{
    public function render($file, $args = [])
    {
        try {
            extract($args);
            ob_start();
            include __DIR__ . sprintf('/../views/%s.php', $file);
            $out = ob_get_contents();
            ob_end_clean();

            return $out;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}