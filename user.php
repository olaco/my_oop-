<?php require_once 'init.php'; ?>

<?php 

class User{
    //    Abstracting tables
    protected static $db_tables = "users";

    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
 
    // set properties for object
    

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;



    public static function find_all_users(){


    return self::find_this_query("SELECT * FROM users");



    }


    public static function find_user_by_id($user_id){
        global $db;

        // $result_set = $db->query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");


        return !empty($the_result_array) ? array_shift($the_result_array) : false;
        
        // if(!empty($the_result_array)){

        //     $first_item = array_shift("$the_result_array");
        //     return $first_item;
        // }else{
        //     return false;
        // }

        
    }



    public static function find_this_query($sql){
        global $db;

        $result_set = $db->query($sql);
        $the_object_array = array();

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    } 


    public static function instantiation($the_record){
         
        $the_object = new self; 
        
        foreach ($the_record as $the_attribute => $value) {
            
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }


    private function has_the_attribute($the_attribute) {


        $object_properties =   get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);
    }


    //  Abstracting properties 

    public function properties(){

         

        $properties = array(); 

        forEach(self::$db_table_fields as $db_field) {

            if(property_exists($this, $db_field)) {

                $properties[$db_field] = $this->$db_field;

                    
                
            }
        }

        return $properties;

    }


    //  Save Method for Abstraction to update if id exist  and createt if no id

    public function save() {

        return isset($this->id) ? $this->update() : $this->create();
    }


    // Create Method


    public function create(){
      global $db;

        $properties = $this->properties();

      $sql = "INSERT INTO  " . self::$db_tables . "(" .  implode(",",array_keys($properties))     .")";

       $sql .= "VALUES ('".   implode("','",array_values($properties)) ."')";
       


       if($db->query($sql)){

        $this->id = $db->insert_id();

        return true;
        
       }else{

        return false;
       }

    }

//   Update

    public function update(){

        global $db;

        $sql = "UPDATE " .self::$db_tables . "  SET ";
        $sql .= "username= '" . $db->escape_string($this->username) . "', ";
        $sql .= "password= '" . $db->escape_string($this->password) . "', ";
        $sql .= "first_name= '" . $db->escape_string($this->first_name) . "', ";
        $sql .= "last_name= '" . $db->escape_string($this->last_name) . "' ";
        $sql .= " WHERE id= " . $db->escape_string($this->id);


       $db->query($sql);
      return (mysqli_affected_rows($db->connection) == 1) ? true : false;
    } 
    
        

    // DELETE

    public function delete(){
        global $db;

        $sql = " DELETE FROM ". self::$db_tables." ";

        $sql .= "WHERE id=" .$db->escape_string($this->id);

        $sql .= " LIMIT 1";

        $db->query($sql);

        return (mysqli_affected_rows($db->connection) == 1) ? true : false;

    }


    
    // END CLASS

}








?>