<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    function read(){
        include '../../config/Database.php';
        $query="SELECT * FROM `list team member`";
        $stmt=$conn->query($query);
        
        return $stmt;
    }
    $result =read();
    $num =$result->num_rows;
    if($num>0){
        $Member_arr=array();
        $Member_arr['Member']=array();
        while($row=$result->fetch_assoc()){
            extract($row);
            $Member_item=array(
                'id'=>$id,
                'nameMember'=> $nameMember,
                'linkFB'=>$linkFB,
                'linkTwitter'=>$linkTwitter,
                'linkInstagram'=>$linkInstagram,
                'avatar'=>$avatar,
            );
            array_push($Member_arr['Member'],$Member_item);

        }
        file_put_contents('db.json', json_encode($Member_arr));
        if(move_uploaded_file('db.json', 'DIKO%20Page/deployjson/')){
           
            echo 'ok.';

        }
        else{
            echo 'nope';
        }
    }else
    {
        echo json_encode(array('Message'=>'no Member'));
    }
?>