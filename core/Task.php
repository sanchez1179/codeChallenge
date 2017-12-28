<?php

    class Task {

        private $task = [];

        public function __construct($post){

            return $this->task = [

                "description" => $post['description'],

                "completed" => false,

                "created on" => date("D M j g:i:s T Y")

            ];

        }

        public function getDescription(){

            return $this->task['description'];

        }

        public function completedTask(){

            $this->task['completed'] = true;
        }
    }