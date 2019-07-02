<?php

namespace App\Service;

class TemplateService
{
    /**
     * @var string
     */
    private $templatesDir;

    public function __construct($templatesDir)
    {
        $this->templatesDir = $templatesDir;
    }

    public function render($template, $viewModel)
    {
        ob_start();
        include_once $this->templatesDir . '/' . $template;

        $output = ob_get_clean();

        return $output;
    }
}