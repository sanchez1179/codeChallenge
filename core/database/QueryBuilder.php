<?php


    class QueryBuilder{

        protected $pdo;


        public function __construct($pdo){

            $this->pdo = $pdo;

        }

        public  function selectAll($table){

            $statement = $this->pdo->prepare("SELECT * FROM ($table)");

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS);

        }

        public function insert($table, $parameters){

            $sql = sprintf(

                'insert into %s (%s) values (%s)',

                $table,

                implode(', ', array_keys($parameters)),

                '"' . (implode('", "', array_values($parameters)).'"')
            );

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute($parameters);

                echo($parameters['description']." task has been added.");


            } catch (Exception $e){

                die($e->getMessage());

            }


        }

        public function updateTask($table, $parameters){

            $arr = [];

            foreach( $parameters as $parameter => $val){


                array_push($arr,"$parameter = \"$val\" ");


            }

            $sql = sprintf(

                'update %s set %s last_updated_date = NOW() where id = %s',

                $table,

                implode(', ', array_values($arr)) . ',',

                2
            );

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute($parameters);

                echo($parameters['name']." task has been updated.");


            } catch (Exception $e){

                die($e->getMessage());

            }
        }

        public function updateCompleted($id){

            $sql = "update tasks set completed_status = true, completed_date = NOW(), last_updated_date = NOW() where id =$id";

            try{

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                echo "your task has been marked complete";
            } catch(Exception $e){

                die($e->getMessage());

            }
        }
    }