<?php
   /*  // connecting to database
    $conn=mysqli_connect('localhost','harshith','qwerty123','todoapp');

    // check connection
    if(!$conn){
        echo 'connection error'.mysqli_connect_error();
    } */
    include('config/db_connect.php');
    // write query for all the todos
    $sql='SELECT title,list,id FROM todos ORDER BY created_at';

    // making query tom data base and get result
    $result =mysqli_query($conn,$sql);

    // fetcing the resulting rows as an associative array
    $todos=mysqli_fetch_all($result,MYSQLI_ASSOC);
    // free results from the memory
    mysqli_free_result($result);
    // close connection
    mysqli_close($conn);
    // print_r($todos);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templetes/header.php')?>
    <h4 class="center grey-text">TODOS</h4>
    <div class="container">
        <div class="row">
            <?php foreach($todos as $todo) { ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($todo['title'])?></h5>
                            <ul>
                                <?php foreach(explode(",",$todo['list']) as $work){ ?>
                                    <li><?php echo $work ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                                <a class="brand-text" href="#">More Info</a>
                        </div>
                    </div>
                </div>
           <?php } ?>
        </div>
    </div>
    <?php include('templetes/footer.php')?>

</html>