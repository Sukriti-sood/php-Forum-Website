<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <title>phpForum</title>
</head>

<body>
    <?php include './partials/_header.php' ?>
    <?php include './partials/_dbconnect.php'?>
    <?php 
        $threadId=$_GET['thread_id'];
        $sql="SELECT * FROM `threads` WHERE `thread_id` =" .$threadId;

        $result=mysqli_query($conn,$sql); 
        while($row=mysqli_fetch_assoc($result)) {
            $title=$row['thread_title'];
            $desc=$row['thread_desc']; 
            $user_id=$row['thread_user_Id'];

            $user_name;
            $sql2 ="SELECT * FROM `users` WHERE `user_id` = ".$user_id;
            $userresult=mysqli_query($conn,$sql2);
            if(!$userresult)
            {
                echo mysqli_error($conn);
            }
            while($row=mysqli_fetch_assoc($userresult))
            {
                $user_name=$row['user_name'];
            }
        } 
        
        ?>
    
    <div class="content">

    <?php
        session_start();
        $showalert=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST')
       {
           if($_SESSION['loggedin'])
           {

            $comment_content=$_POST['content'];
            $user_id=$_SESSION['user_id'];
           $sql= "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_time`, `comment_by`) 
                  VALUES ('$comment_content', '$threadId', current_timestamp(), '$user_id')";
           $result=mysqli_query($conn,$sql);       
           if($result)
           {
               $showalert=true;
           }
           else
           {
               echo mysqli_error($conn);
           }
           if($showalert)
           {
               echo '
               
               <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Holy guacamole!</strong> Your comment has been added 🎉.Hope it resolves the user issues, 🎉.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
               
               ';
           }

           }
           else
           {
            echo '
                
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Login , First</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            ';
           }
           
        }
        ?>
        <div class="p-5 my-3 mb-4 bg-light rounded-3 container">
            <div class="container-fluid py-5">
                <h1 class="display-5"><?php echo $title?> </h1>
                <p class="col-md-8 fs-5"><?php echo $desc?></p>
                <hr class="my-4">
                <p>Some Rules</p>
                <p class="text-left"><b>Posted by: <?php echo $user_name?></b></p>
            </div>
        </div>

        <div class="container">
            <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
            <h1 class="py-2">Post a Comment</h1>
                <div class="form-floating">
                    <textarea name="content" class="form-control" placeholder="Leave a comment here" id="content"></textarea>
                    <label for="floatingTextarea">Type your comment</label>
                </div>
                <button type="submit" class="btn my-2 btn-success">Submit</button>
            </form>
        </div>
        <div class="container">
            <h1 class="py-2">Discussion</h1>

            <?php 
            $thread_id=$_GET['thread_id'];
            $sql='SELECT * FROM `comments` WHERE `thread_id` ='.$thread_id;
            $noresult=true;
            $result=mysqli_query($conn,$sql); 
            while($row=mysqli_fetch_assoc($result)) {
                $noresult=false;
                $id=$row['comment_id'];
                $content=$row['comment_content'];
                $comment_time=$row['comment_time'];
                $user_id=$row['comment_by'];
                $time=date('M j,Y',strtotime($comment_time));
                $sql2 ="SELECT * FROM `users` WHERE `user_id` = ".$user_id;

                $userresult=mysqli_query($conn,$sql2);

                while($row=mysqli_fetch_assoc($userresult))
                {
                    $user_name=$row['user_name'];
                }

                echo 
                '<div class="d-flex my-3">
                    <div class="flex-shrink-0">
                        <img src="./images/user-default.png" width="34px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                    <p class="fw-bold mb-1">'.$user_name.' at '.$time.'</p>
                        '.$content.'
                    </div>
                </div>';                

            } 
        
            if($noresult)
            {

            echo '
            <div class="p-5 my-3 mb-4 bg-light rounded-3 container">
            <div class="container-fluid py-1">
                <p class="display-5">No Answer Found</p>
                <p class="col-md-8 fs-4">Be the First Answer this question</p>
            </div>
        </div>
            ';
            }

        ?>

        </div>


    </div>
    <?php include './partials/_footer.php' ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>