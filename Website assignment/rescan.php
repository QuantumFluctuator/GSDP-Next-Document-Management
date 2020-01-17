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
        mysqli_query($connect, "DELETE FROM TagLink");
        mysqli_query($connect, "DELETE FROM documents");


        while ($i < count($results)) {
            $name = basename($results[$i]);
            $loc = str_replace($name, "", $results[$i]);
            $author = str_replace("0", "Unknown", fileowner("Documents/" . $results[$i]));
            $last = date("Y-m-d", filemtime("Documents/" . $results[$i]));

            $insert = mysqli_query($connect, "INSERT INTO documents (Name, Author, LastModified, Location, Approved) VALUES ('$name', '$author', '$last', '$loc', FALSE)");

            echo "<br>" . $connect->error;

            $i++;
        }

        $connect->close();
        header("Location: adminindex.php");
        die();
        ?>
    </body>
</html>