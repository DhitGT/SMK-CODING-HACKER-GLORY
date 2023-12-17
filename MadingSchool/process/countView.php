<?php 
    $currentDate = date("Y-m-d");
    if(!isset($_SESSION['views'])){

        if(checkIsCurrentDate($currentDate)){
            $viewData = mysqli_fetch_assoc(getUserViewsDataByDate($currentDate));
            $views = $viewData['views'] + 1;
            $sqlIncreaseView = "UPDATE `user_views` SET `views` = '$views' WHERE `view_date` = '$currentDate'";
        }else{
            $sqlIncreaseView = "INSERT INTO user_views VALUES('','$currentDate','1')";
        }
        mysqli_query(conn(),$sqlIncreaseView);
        $_SESSION['views'] = true;
    }

    function checkIsCurrentDate($currentDate){
        $query = mysqli_query(conn(),"SELECT * FROM user_views WHERE view_date = '$currentDate'");

        return mysqli_num_rows($query);
    }

    function getUserViewsDataByDate($currentDate){
        $sql = "SELECT * FROM user_views WHERE view_date = '$currentDate'";
        return mysqli_query(conn(),$sql);
    }

?>