<?php


namespace App\core;


class BaseController
{
    public $layout = 'base';

    public function render($template, $args = [], $status = 200)
    {
        http_response_code ($status);
        foreach ($args as $key => $value) {
            $$key = $value;
        }

        $template = str_replace('.', DS, $template);
        $template .= '.php';
        $templatePath = base_path . DS . 'app' . DS . 'views' . DS . $template;

        ob_start();
        if (file_exists($templatePath)) {
            include $templatePath;
        } else {
            include base_path . DS . 'app' . DS . 'views'
                . DS . 'home' . DS
                . '404.php';
        }
        $content = ob_get_clean();
        if ($this->layout) {
            include base_path . DS . 'app' . DS . 'views' . DS . 'layouts' . DS
                . $this->layout . '.php';
        } else {
            echo $content;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}