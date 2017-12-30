<?php

    class Task {

        public $task = [];

        public function __construct($post){

            $date = new DateTime('now', new DateTimeZone("America/Los_Angeles"));

            return $this->task = [

                "name" => $post['name'],

                "description" => $post['description'],

                "created_date" => $date->format('Y-m-d H:i:s')

            ];

        }

        public function getDescription(){

            return $this->task['description'];

        }

        public function completedTask(){

            $this->task['status'] = true;

        }

        public function getTask(){

            return $this->task;
        }
    }