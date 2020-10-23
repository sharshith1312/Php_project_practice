<?php
    include('config/db_connect.php');
    $erros=['email'=>'',"title"=>'','list'=>''];
    $email=$title=$list='';
    
    if(isset($_POST['submit'])){
        
        // print_r($_POST);
        // echo htmlspecialchars($_POST["email"]);
        // echo htmlspecialchars($_POST["title"]);
        // echo htmlspecialchars($_POST["list"]);
        
        if(empty($_POST['email'])){
            // echo "email is required";
            $erros['email']="email is required";
        }
        else{
            // echo htmlspecialchars($_POST["email"]);
            $email=$_POST["email"];
            
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                // echo "email must be valid";
                $erros['email']="email must be valid";
            }
        }

        if(empty($_POST['title'])){
            // echo "title is required";
            $erros['title']="title is required";
        }
        else{
            // echo htmlspecialchars($_POST["title"]);
            $title= htmlspecialchars($_POST["title"]);
            if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
                // echo "Title must be letter and spaces only";
                $erros['title']="Title must be letter and spaces only";
            }
        }

        if(empty($_POST['list'])){
            // echo "Todo list is required";
            $erros['list']="Todo list is required";
            
        }
        else{
            // echo htmlspecialchars($_POST["list"]);
            $list= htmlspecialchars($_POST["list"]);
            if(!preg_match('/.*/',$list)){
                // echo "Enter valid thing";
                $erros['list']="Todo list is required";
            }
        }

        if(array_filter($erros)){
     
            echo 'errors in the form';
        }
        else{
            // all values are empty strings
            // echo 'form is valid';
            // header('Location:index.php');
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $list=mysqli_real_escape_string($conn,$_POST['list']);
            $sql="INSERT INTO todos(title,email,list) values('$title','$email','$list')";

            if(mysqli_query($conn,$sql)){
                header('Location:index.php');
            }
            else{
                echo 'query error'.mysqli_error($conn);
            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templetes/header.php')?>
    <section class="container flow-text">
        <h4 class="center">Add a todo list</h4>
        <form class="white" action="add.php" method="POST">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $erros['email'] ?></div>
            <label>TODO Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $erros['title'] ?></div>
            <label>Your List</label>
            <textarea style="height:150px" name="list"><?php echo htmlspecialchars($list) ?></textarea>
            <div class="red-text"><?php echo $erros['list'] ?></div>
            <div class="center">
                <input type="submit" name="submit" class="btn brand z-depth-0">
            </div>
        </form>
        
    </section>
    <?php include('templetes/footer.php')?>

</html>
