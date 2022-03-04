<?php

    function getCategory($db,$id){
        $q = "SELECT * from category WHERE id=$id";
        $r = mysqli_query($db,$q);
        $data = mysqli_fetch_assoc($r);
        return $data['name'];
    }
    function getimages($db,$article_id){
        $q = "SELECT * from images WHERE article_id=$article_id";
        $r = mysqli_query($db,$q);
        $data = array();
        while($d = mysqli_fetch_assoc($r)){
            $data[] = $d;
        }
        return $data;
    }


?>