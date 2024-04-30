<?php

namespace App\Core;

class View
{
        /**
         * @var string
         */
        private string $_name_of_view;

        /**
         * @var array|mixed
         */
        private mixed $variables;

        /**
         * @var string
         */
        private string $path_of_view;

    public function __construct($_name_of_view, $variables = [])
        {
                $this->_name_of_view = $_name_of_view;
                $this->variables = $variables;
                $this->path_of_view =  $_SERVER['DOCUMENT_ROOT'] . "/App/View/" . $this->pathOfView() . ".php";
        }

        public function pathOfView()
        {
            //Name of the view can be like this movie.index or movie.distributor.index
            //We need to parse it to get the path of the view
            //We need to replace . with /
            //movie.index => movie/index

            return str_replace('.', '/', $this->_name_of_view);
        }

    public function render(): string
    {
        return $this->parseFile($this->path_of_view);
    }

    private function parseFile(string $file): string
    {
        if (!file_exists($file)) {
            throw new \Exception("File '$file' not found.");
        }

        ob_start(); // Démarrer la temporisation de sortie

        // Inclure le fichier avec le code PHP
        include $file;

        $content = ob_get_clean(); // Récupérer le contenu du tampon de sortie et arrêter la temporisation

        extract($this->variables);

        // Initialize variables array
        $variables = array_keys($this->variables);

        // Search and replace variables
        foreach ($variables as $variable) {
            // put value of variable in $variable
            $$variable = $this->variables[$variable];
            // Replace {{ $variable }} by $variable
            $content = str_replace("{{ $variable }}", $$variable, $content); // Replace each variable
        }

        return $content;
    }
}