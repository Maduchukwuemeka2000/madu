<?php
//Note: the database will have a to_do column,Time column and id column


class Query {
    private $table="To_Do__List";
    private $query;
    private $To_Do;
    private $id;
    private $time;

    public function __construct($db , $time=null , $to_do='' , $id = null){
         
        
        $this->time = $time;
        $this->id = $id;
        $this->to_do = $to_do;

         //connecting to the database
         $this->db = $db;
}



//Adding A To_Do Item To The Table
    public function Create_To_Do(){
         $this->query = <<< query
             INSERT INTO $this->table 
             SET TO_DO = :TO_DO
             , TIME = :TIME
         query; 

        //Preparing Task
         $smt = $this->db->prepare($this->query);

        //Binding The Parameter        
         $smt->bindParam(':TO_DO' , $this->To_Do);
         $smt->bindParam(':TIME' , $this->time);
         $smt->execute();
        
}


//Reading The To_Do Table
    function Read(){ 
        $this->query = <<< query
            SELECT * FROM  $this->table  
        query; 

        //Preparing Task
        $smt = $this->db->prepare($this->query);
        $smt->execute();


        //Checking If Table Is Not Empty
        if($smt->rowcount > 0){

                            //Initiating An Empty Array
                            $arr=array();
                            
                            
                            //Returning The Fetch
                            while($fetch = $smt->fetch(PDO::FETCH_ASSOC)){
                                        extract($fetch);
                                        $arr['To_Do'] = $To_Do;
                                        $arr['Time'] =$Time;
                    }
                            return $arr;
            }

        //If No To_Do item Available
        else{
                return "Nothing Left To Do";
            }
            
            
}


//Updating The To_Do Table
    public function Update(){  
         $this->query = <<< query
            UPDATE $this->table 
            SET TO_DO = :TO_DO  AND TIME = :TIME
            WHERE id = :id
         query; 

        //Preparing Task
         $smt = $this->db->prepare($this->query);

        //Binding The P arameter        
         $smt->bindParam(':TO_DO' , $this->To_Do);
         $smt->bindParam(':id' , $this->id);
         $smt->bindParam(':TIME',$this->time);

         $smt->execute();
        

}


//Deleting From To_Do Table
    public function Delete(){
        $this->query = <<< query
            DELETE FROM $this->table 
            WHERE TO_DO = :TO_DO
        query; 
    
        //Preparing Task
        $smt = $this->db->prepare($this->query);

        //Binding The Parameter        
        $smt->bindParam(':TO_DO' , $this->To_Do);
        $smt->execute();
              
}



//Reading A Singel To_Do Table
    public function Read_single(){ 
        $this->query = <<< query
            SELECT * FROM  $this->table   WHERE ID = ?
        query; 

        //Preparing Task
        $smt = $this->db->prepare($this->query);

        //Binding The Parameter        
        $smt->bindParam('1' , $this->id);
        $smt->execute();

        
        //Checking If Table Is Not Empty
        if($smt->rowcount > 0){
                $arr=array();

                //Returning The Fetch
                while($fetch = $smt->fetch(PDO::FETCH_ASSOC)){
                            extract($fetch);
                            $arr['To_Do'] = $To_Do;
                            $arr['Time'] = $Time;
        }
                return $arr;
        }

        // If To_Do table is Empty
        else{
            return "Nothing Left To Do";
        }

        

}

}
