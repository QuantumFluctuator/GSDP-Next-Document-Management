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
        
        $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");

        if (!$connect) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die(mysqli_error());
        }
        
        $i = 0;
        
        mysqli_query($connect, "DELETE FROM Rating");
        mysqli_query($connect, "DELETE FROM documents");
        mysqli_query($connect, "DELETE FROM TagLink");
        
        
        while ($i < count($results)) {
            $name = basename($results[$i]);
            $loc = str_replace($name, "", $results[$i]);
            $author = str_replace("0", "Unknown", fileowner("Documents/" . $results[$i]));
            $last = date("Y-m-d", filemtime("Documents/" . $results[$i]));
            
            $id = $i;
            
            $insert = mysqli_query($connect, "INSERT INTO documents (ID, Name, Author, LastModified, Location, Approved) VALUES ($id, '$name', '$author', '$last', '$loc', FALSE)");

            echo $sql . "<br>" . $connect->error;
        
            $i++;
        }
        
        $connect->close();
        header("Location: index.php");
        die();
        ?>
    </body>
</html>