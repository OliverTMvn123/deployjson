<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    function read(){
        include '../../config/Database.php';
        $query="SELECT * FROM `client`";
        $stmt=$conn->query($query);
        
        return $stmt;
    }
    $result =read();
    $num =$result->num_rows;
    if($num>0){
        $Member_arr=array();
        $Member_arr['data']=array();
        while($row=$result->fetch_assoc()){
            extract($row);
            $Member_item=array(
                'id'=>$id,
                'nameMember'=> $nameClient,
                'feedback'=>$feeback,
                'avatar'=>$avatar,
            );
            array_push($Member_arr['data'],$Member_item);

        }
        echo file_put_contents('db.json', json_encode($Member_arr));
    }else
    {
        echo json_encode(array('Message'=>'no Member'));
    }
?>