    <?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $name = $fileToUpload['name'];
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getfilesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) 
    {
        echo "File is a document - " . $check["mime"] . ".";
        $uploadOk = 1;
    } 
    else {
        echo "File is not a document.";
        $uploadOk = 0;
        }
    }

    $path = "/uploads/" . basename($name);
    if (move_uploaded_file($fileToUpload['tmp_name'], $path)) {
        // Move succeed.
        echo "File uploaded succesfully."
    } else {
        // Move failed. Possible duplicate?
        echo "File upload failed, check if your document is a duplicate."
    }

    //connecting to table
    $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");

     while($row = mysql_fetch_array($query))
        {
                    $docID = $row['ID'];
                    $docName = $row['Name'];
                    $loc = $row['Location'];
                    $moddate = $row['LastModified'];
                    $rated = $row['Rating'];
                    $approved=$row['Approved']
                    $author = $row['Author'];
        }

    //inserting uploaded file 
    $sql = "INSERT INTO documents (path) VALUES ('" . mysqli_real_escape_string($path) . .$docID.' '.$docName.' '.$loc.' '.$moddate.' '.$rated.' '.$approved.' '.$author."')";

// Check file size
if ($_FILES["fileToUpload"]["size"] > 100000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
    // Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "doc" && $fileType != "docx" && $fileType != "txt") {
    echo "Sorry, only DOC, DOCX and TXT files are allowed.";
    $uploadOk = 0;
}
    ?>