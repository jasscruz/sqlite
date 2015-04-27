<?php
   class database
   {

      public $database = 'database\dashboard.db';
      private $tableSettings = 'settings';
      private $tableCommands = 'commands';

      public function __construct()
      {
         $this->db = new SQLite3($this->database);
         $this->setConfiguration();         
      }

      public function exists($key) {
         
         $i=0;
         $data = NULL;

         $sql ="SELECT * FROM ".$this->tableSettings." WHERE key='".$key."'";
         $ret = $this->db->query($sql);

         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $data[$i]['id'] = $row['id'];
            $data[$i]['key'] = $row['key'];
            $data[$i]['value'] = $row['value'];
            $i++;
         }
         return $data = sizeof($data)>0 ? true : false ;
      }

      public function select() {
         
         $i=0;
         $data = NULL;

         $sql ="SELECT * FROM ".$this->tableSettings."";
         $ret = $this->db->query($sql);

         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $data[$i]['id'] = $row['id'];
            $data[$i]['key'] = $row['key'];
            $data[$i]['value'] = $row['value'];
            $i++;
         }
         return $data;
      }

      public function insert($key,$value) {
         
         $sql ="INSERT INTO ".$this->tableSettings." 
                  ( 
                     key,
                     value 
                  )
                VALUES 
                  ( 
                     '".$key."',
                     '".$value."' 
                  );";

         $ret = $this->db->exec($sql);
         $result = $ret ? true : false;
         return $result;
      }

      public function update() {
         $sql ="UPDATE ".$this->tableSettings." set key = '' where id=1";
         $ret = $this->db->exec($sql);
         $result = $ret ? $db->changes() : false;
         return $result;      

      }

      public function delete($value) {
         $sql ="DELETE FROM ".$this->tableSettings." WHERE id='".$this->value."' ";
         $ret = $this->db->exec($sql);
         $result = $ret ? $db->changes() : false;
         return $result;
      }

      public function tableSettings() {
         $sql ="CREATE TABLE IF NOT EXISTS ".$this->tableSettings."(
                     id INT PRIMARY KEY,
                     key TEXT NOT NULL,
                     value CHAR(50)
               );";

         $ret = $this->db->exec($sql);
         $result = $ret ? true : false;
         return $result;
      }  

      public function tableCommands() {
         $sql ="CREATE TABLE IF NOT EXISTS ".$this->tableCommands."(
                     id INT PRIMARY KEY,
                     type TEXT NOT NULL,
                     key TEXT NOT NULL,
                     value CHAR(50)
               );";

         $ret = $this->db->exec($sql);
         $result = $ret ? true : false;
         return $result;
      }

      public function seedCommands() {
         
         # Commands for Composer
         $sql  ="INSERT INTO ".$this->tableCommands." (type,key,value) VALUES ('composer','Jasson','Cruz');";
         # Commands for php artisan
         $sql .="INSERT INTO ".$this->tableCommands." (type,key,value) VALUES ('artisan','Jasson','Cruz');";
         # Commands for php linux
         $sql .="INSERT INTO ".$this->tableCommands." (type,key,value) VALUES ('linux','Jasson','Cruz');";

         $ret = $this->db->exec($sql);
         $result = $ret ? true : false;
         return $result;
      }    

      public function selectCommands() {
         echo 'entra?';
         $i=0;
         $data = NULL;

         $sql ="SELECT * FROM ".$this->tableCommands."";
         $ret = $this->db->query($sql);

         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $data[$i]['id'] = $row['id'];
            $data[$i]['type'] = $row['type'];
            $data[$i]['key'] = $row['key'];
            $data[$i]['value'] = $row['value'];
            $i++;
         }

         echo '<pre>';
            print_r($data);
         echo '</pre>';
         die();
         return $data;
      }


      public function setConfiguration() {
         $result = $this->tableSettings();
         $result = $this->tableCommands(); 
         $result = $this->seedCommands();        
         $result = $this->selectCommands();        
      }  

      public function close() {
         $this->db->close();
      }    
   }

?>