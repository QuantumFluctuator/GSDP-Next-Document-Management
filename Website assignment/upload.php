<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload Document</title>
        <link href="css/main.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div id="container">
            <header>
                <div id="logo">
                    <h1><a href="index.php">NEXT DOCUMENT MANAGER</a></h1>
                </div>
            </header>

            <form action="#file" method='post' enctype="multipart/form-data">
                Filepath: <input type="text" name="path"/>
                <input type="file" name="file">
                <input type="submit" name="submit" value="Upload">


                <?php
                if(isset($_POST['submit'])) 
                {   
                    echo "<br>1. ";
                    echo $name= $_FILES['file']['name'];
                    echo "<br>2. ";
                    echo $tmp_name= $_FILES['file']['tmp_name'];
                    echo "<br>3. ";
                    echo $submitbutton= $_POST['submit'];
                    echo "<br>4. ";
                    echo $position= strpos($name, ".");
                    echo "<br>5. ";
                    echo $fileextension= substr($name, $position + 1);
                    echo "<br>6. ";
                    echo $fileextension= strtolower($fileextension);
                    echo "<br>7. ";
                    echo $path= $_POST['path']; // saves description enterd
                    $connect = mysqli_connect("localhost", "next", "nextTeam2", "nextDocumentManager");

                    if (!$connect) {
                        echo "Failed to connect";
                    }
                    if (isset($name)) 
                    {
                        if (!empty($name))
                        {
                            if (move_uploaded_file($name, $path)) 
                            {
                                echo "P!";
                            }
                        }
                    }
                }

                if(!empty($path))
                {
                    $file_pointer = $path; 
                    if (file_exists($file_pointer))
                    {
                        echo "The file $file_pointer exists"; 
                        mysqli_query($connection,"INSERT INTO documents (Name, Location, Approved)
                    VALUES ('$name', '$path', FALSE)");
                    }
                    else 
                    { 
                        echo "The file $file_pointer does not exists"; 
                    } 

                }
                mysqli_close($connection);
                ?>
            </form>
            <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>