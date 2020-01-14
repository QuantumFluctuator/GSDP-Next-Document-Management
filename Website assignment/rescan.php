<!doctype html>
<html>
    <head>
        <title>Rescan Files</title>
    </head>
    <body>
        <?php
        function getDirContents($dir, &$results = array()){
            $files = scandir($dir);

            foreach($files as $key => $value){
                $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
                if(!is_dir($path)) {
                    $results[] = str_replace("/var/www/html/DocumentManager/Documents/", "", $path);
                } else if($value != "." && $value != "..") {
                    getDirContents($path, $results);
                    //$results[] = str_replace("/var/www/html/DocumentManager/Documents/", "", $path);
                }
            }

            return $results;
        }
        
        $results = array();
        $results = getDirContents('Documents/');
        
        //var_dump(getDirContents('Documents/'));
        
        $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");

        if (!$connect) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die(mysqli_error());
        }
        
        $i = 0;
        
        //print_r($results);
        
        $delete = mysqli_query($connect, "DELETE FROM documents WHERE 1");

        if ($connect->query($delete) === TRUE) {
            echo "<br>Table cleared successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
        
        while ($i < count($results)) {
            $name = basename($results[$i]);
            $loc = str_replace($name, "", $results[$i]);
            
            $id = $i;
            
            $insert = mysqli_query($connect, "INSERT INTO documents (ID, Name, Location, Approved) VALUES ($id, '$name', '$loc', FALSE)");

            if ($connect->query($insert) === TRUE) {
                echo "<br>New record created successfully";
            } else {
                echo "<br>Error: " . $sql . "<br>" . $connect->error;
            }
        
            $i++;
        }
        
        $connect->close();
        ?>
    </body>
</html>