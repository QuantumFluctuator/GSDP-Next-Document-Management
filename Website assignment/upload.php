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

             <input type="file" id="myFile" name="filename">
             <button type="file" name="fileToUpload" id="fileToUpload"> Upload Document </button>


            <?php
            if(isset($_POST['submit'])) 
            {   
                    $name= $_FILES['file']['name'];

                    $tmp_name= $_FILES['file']['tmp_name'];

                    $submitbutton= $_POST['submit'];

                    $position= strpos($name, "."); 

                    $fileextension= substr($name, $position + 1);

                    $fileextension= strtolower($fileextension);

                    $description= $_POST['description_entered']; // saves description enterd 


            $dbase = "documents";
            $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
        
            if (!$connect) {
                echo "Failed to connect";
            }


            if (isset($name)) 
            {

                $path= 'uploads/files/';

            if (!empty($name))
            {
                if (move_uploaded_file($tmp_name, $path.$name)) 
                {

                }
            }
        }
    }
            ?>

            <?php

            // Include the database configuration file

        
            mysqli_select_db($connection, $dbase);

            if(!empty($description))
            {
                $file_pointer = $description; 

                if (file_exists($file_pointer))
                {
                    echo "The file $file_pointer exists"; 
                    mysqli_query($connection,"INSERT INTO $table (description, filename)
                    VALUES ('$description', '$name')");
                }

                else 
                { 
                    echo "The file $file_pointer does not exists"; 
                } 
    
            }



            mysqli_close($connection);

            ?>

            <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>