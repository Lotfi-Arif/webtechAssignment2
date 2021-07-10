<?php
class Banner{
    //DB stuff
    public $conn;

    //Constructor with DB
    public function __construct(){
        $servername ="db";
        $username ="root";
        $password="Web.Tech123";
        $dbname="dev_profile";


        // Create connection
		$this->conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$this->conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
    }

    //Get Banner Link
    public function getBannerLink(){
        $sql = "select * FROM banner";
        $result = $this->conn->query($sql);

        $row = array();
            
        while($r = mysqli_fetch_assoc($result)){
        $row[] = $r;
        }

        return $row;     

    }

    public function insertBannerLink($datas){
        $img1 = $datas['img1'];
        
        for ($j=0; $j<1; $j++){
            if($j==0){
              $sql = "insert into banner (imageLink)".
              "values ('$img1')";
            }
            if($this->conn->query($sql) == TRUE){

                $response = [
                    'message' => 'New Banner added successfully',
                ];
               
            } else{
                $response = ['message' => 'Failed to add new banner image'];
            } 
        }

        return $response;
    }
}

?>