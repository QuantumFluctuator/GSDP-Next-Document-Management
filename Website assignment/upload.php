<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload Document</title>
        <link href="css/main.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <header>
                <div id="logo">
                    <h1><a href="index.php">NEXT DOCUMENT MANAGER</a></h1>
                </div>
            </header>

            <form action="#file" method='post' enctype="multipart/form-data">
                Filepath: <input type="text" name="path"/>
                Author: <input type="text" name="author"/>
                <input type="file" name="file">
                <input type="submit" name="submit" value="Upload" class="input">


                <?php
                if(isset($_POST['submit'])) 
                {   
                    $name= $_FILES['file']['name'];
                    $tmp_name= $_FILES['file']['tmp_name'];
                    $submitbutton= $_POST['submit'];
                    $position= strpos($name, ".");
                    $fileextension= substr($name, $position + 1);
                    $fileextension= strtolower($fileextension);
                    $path= $_POST['path']; // saves path entered
                    $author= $_POST['author']; // saves author entered
                    $connect = mysqli_connect("localhost", "next", "nextTeam2", "nextDocumentManager");
                    if (!$connect) {
                        echo "Failed to connect";
                    }
                    if (isset($name)) 
                    {
                        if (!empty($name))
                        {
                            if (move_uploaded_file($tmp_name, $path.$name)) 
                            {
                                echo "Successfully transferred!";
                            }
                        }
                    }
                }
                if(!empty($path))
                {
                    $file_pointer = $path;
                    $path = str_replace("Documents/", "", $path);
                    $date = date("Y-m-d");
                    $insert = "INSERT INTO documents (Name, Location, LastModified, Author, Approved) VALUES ('$name', '$path', '$date', '$author', FALSE)";
                    //$sql = mysqli_query($connection,"INSERT INTO documents (Name, Location, Approved) VALUES ('$name', '$path', FALSE)");
                    if ($connect->query($insert) === TRUE) {
                        echo "<br>New record created successfully";
                    } else {
                        echo "<br>Error: " . $sql . "<br>" . $connect->error;
                    }
                }
                mysqli_close($connection);
                ?>
            </form>
            <div class=container>
                <button class="cancelbtn" type="submit" onclick="location.href='index.php' ">Back</button>
            </div>
            <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>