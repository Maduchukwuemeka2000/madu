<?php
//Note: the database will have a to_do column , Time column and id column

class Query
{
    private $table = "to_do";
    private $dbname;
    private $query;
    public $To_Do;
    public $id;
    public $time;
    private $db;

    public function __construct($db, $to_do = '', int $id = null, $time = 'now')
    {

        $this->id = htmlspecialchars((strip_tags($id)));
        $this->time = htmlspecialchars((strip_tags($time)));
        $this->To_Do = htmlspecialchars((strip_tags($to_do)));

        //connecting to the database
        $this->db = $db;

    }

//Adding A To_Do Item To The Table
    public function create_to_do()
    {

        //creating the query for inserting data in your to_do list
        $this->query = <<< query
             INSERT INTO $this->dbname.$this->table
             SET TO_DO = :TO_DO ,
             TIME = :TIME

         query;

        //Preparing Task
        $smt = $this->db->prepare($this->query);

        //Binding The Parameter
        $smt->bindParam(':TO_DO', $this->To_Do);
        $smt->bindParam(':TIME', $this->time);

        //checking if it is executed
        if ($smt->execute()) {
            return true;
        } else {
            printf("Error %s \n", $smt->error);
            return false;
        }

    }

//Reading The To_Do Table
    public function read()
    {

        //creating the query for getting all to_do items
        $this->query = <<< query
            SELECT * FROM  $this->dbname.$this->table
        query;

        //Preparing Task
        $smt = $this->db->prepare($this->query);
        $smt->execute();

        //Checking If Table Is Not Empty
        if ($smt->rowCount() > 0) {

            //Initiating An Empty Array
            $arr = array();
            $arr['data'] = array();

            //Returning The Fetch
            while ($fetch = $smt->fetch(PDO::FETCH_ASSOC)) {

                //creating an empty array
                $ar = array();
                extract($fetch);
                $ar['To_Do'] = $to_do;
                $ar['Time'] = $time;

                //pushing array into the data
                array_push($arr['data'], $ar);
            }
            return $arr;
        }

        //If No To_Do item Available
        else {
            return "Nothing Left To Do";
        }

    }

//Updating The To_Do Table
    public function update()
    {

        //creating the query for updating the database
        $this->query = <<< query
            UPDATE $this->dbname.$this->table
            SET TO_DO = :TO_DO,
            TIME = :TIME
            WHERE id = :id
         query;

        //Preparing Task
        $smt = $this->db->prepare($this->query);

        //Binding The P arameter
        $smt->bindParam(':TO_DO', $this->To_Do);
        $smt->bindParam(':id', $this->id);
        $smt->bindParam(':TIME', $this->time);

        //checking if query was executed
        if ($smt->execute()) {
            return true;
        } else {
            printf("Error: %s ", $smt->error);
            return false;
        }

    }

//Deleting From To_Do Table
    public function delete()
    {

        //creating the query for deleting a to_do from the to_do list
        $this->query = <<< query
            DELETE FROM $this->dbname.$this->table
            WHERE TO_DO = :TO_DO  OR ID = :ID
        query;

        //Preparing Task
        $smt = $this->db->prepare($this->query);

        //Binding The Parameter
        $smt->bindParam(':TO_DO', $this->To_Do);
        $smt->bindParam(':ID', $this->id);
        $smt->execute();

    }

//Reading A Singel To_Do Table
    public function read_single()
    {

        //creating the query for getting a single_to_do item from the to_do list
        $this->query = <<< query
            SELECT * FROM  $this->dbname.$this->table   WHERE ID = ?
        query;

        //Preparing Task
        $smt = $this->db->prepare($this->query);

        //Binding The Parameter
        $smt->bindParam(1, $this->id);
        $smt->execute();

        //Checking If Table Is Not Empty
        if ($smt->rowCount() > 0) {
            $arr = array();
            $arr['data'] = array();

            //Returning The Fetch
            while ($fetch = $smt->fetch(PDO::FETCH_ASSOC)) {
                extract($fetch);

                //creating an empty array
                $ar = array();
                $ar['To_Do'] = $to_do;
                $ar['Time'] = $time;

                //pushing the array
                array_push($arr['data'], $ar);
            }
            return $arr;
        }

        // If To_Do table is Empty
        else {
            return "Nothing Left To Do";
        }

    }
//reseting the id of the table after every altering
    public function __destruct()
    {

        //creating the query for reseting id for every altering or deleting made in the to_do  table
        $query = <<< query
    SET @num := 0 ;
    UPDATE $this->table SET ID = @num := (@num + 1);
    ALTER TABLE $this->table AUTO_INCREMENT = 1;
    query;
        $smt = $this->db->prepare($query);

        //echoing the error if not reset
        if (!$smt->execute()) {
            echo $smt->error;
        }

    }

}
