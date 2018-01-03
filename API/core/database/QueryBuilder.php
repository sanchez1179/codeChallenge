<?php


    class QueryBuilder
    {

        protected $pdo;


        public function __construct($pdo)
        {

            $this->pdo = $pdo;

        }

        public function selectAll($table)
        {

            $statement = $this->pdo->prepare("SELECT * FROM ($table)");

            $statement->execute();

            $results = $statement->fetchAll(PDO::FETCH_CLASS);

            echo json_encode($results);

        }

        public function insert($table, $parameters)
        {

            $sql = sprintf(

                'insert into %s (%s) values (%s)',

                $table,

                implode(', ', array_keys($parameters)),

                '"' . (implode('", "', array_values($parameters)) . '"')
            );

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute($parameters);

                echo($parameters['description'] . " task has been added.");


            } catch (Exception $e) {

                die($e->getMessage());

            }


        }

        public function updateTask($table, $parameters, $id)
        {

            $arr = [];

            foreach ($parameters as $parameter => $val) {


                array_push($arr, "$parameter = \"$val\" ");


            }

            $sql = sprintf(

                'update %s set %s last_updated_date = NOW() where id = %s',

                $table,

                implode(', ', array_values($arr)) . ',',

                $id
            );

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                echo($parameters['name'] . " task has been updated.");


            } catch (Exception $e) {

                die($e->getMessage());

            }
        }

        public function updateToCompleted($id)
        {

            $sql = "update tasks set completed_status = true, completed_date = NOW(), last_updated_date = NOW() where id =$id";

            $sql2 = "select * from tasks where id = $id";

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                $statement = $this->pdo->prepare($sql2);

                $statement->execute();

                $record = $statement->fetch(PDO::FETCH_ASSOC);

                echo $record['name']." task has been marked as completed!";

            } catch (Exception $e) {

                die($e->getMessage());

            }
        }

        public function checkCompletedCount()
        {

            $sql = "select count(*) as \"incomplete tasks\" from tasks where completed_status = 0";

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                $result = $statement->fetch();

                $numberOfResults = $result['incomplete tasks'];

                return $numberOfResults;

            } catch (Exception $e) {

                die($e->getMessage());

            }
        }

        public function getRecord($id)
        {

            $sql = "select * from tasks where id = $id";

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                $record = $statement->fetch(PDO::FETCH_ASSOC);

                return $record;

            } catch (Exception $e) {

                die($e->getMessage());

            }

        }

        public function deleteRecord($id){

            $sql = "delete from tasks where id  = $id";

            try{

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                echo "record has been deleted";

            }catch (Exception $e) {

                die($e->getMessage());

            }

        }

        public function updateToIncomplete($id){

            $sql = "update tasks set completed_status = false, completed_date = NOW(), last_updated_date = NOW() where id =$id";

            $sql2 = "select * from tasks where id = $id";

            try {

                $statement = $this->pdo->prepare($sql);

                $statement->execute();

                $statement = $this->pdo->prepare($sql2);

                $statement->execute();

                $record = $statement->fetch(PDO::FETCH_ASSOC);

                echo $record['name']." task has been marked as incomplete!";

            } catch (Exception $e) {

                die($e->getMessage());

            }
        }

    }