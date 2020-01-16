<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Add Ratings</title>
        <link href="css/main.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <header>
                <div id="logo">
                    <h1><a href="index.php">NEXT DOCUMENT MANAGER</a></h1>
                </div>
            </header>
            <form class="bordered">
                <legend><h3>Add Rating</h3></legend>
                <label>Enter a document ID:</label>
                <input type="text" name="DocID"/>
                <label>Enter a rating 1-5:</label>
                <input type="text" name="Rating"/>

                <?php
                if (!empty($_GET['act'])) 
                {
                    $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
                    if (!$connect) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        die(mysqli_error());
                    }
                    $id= $_GET['DocID']; // saves description enterd 
                    $rating= $_GET['Rating'];
                    $MaxID = mysqli_query($connect, "SELECT COUNT(ID) FROM documents");
                    if($id > $MaxID){
                        echo "Enter a ID Below".($MaxID);
                    }
                    if (($rating  < 0 ) || ($rating > 5)) {
                        echo "Enter a value between 1 and 5";
                    }
                    if (($rating  > 0 ) || ($rating < 6) && ($id <= $MaxID)){
                        // TODO: Need to add user when login is added 
                        $insert = mysqli_query($connect,"INSERT INTO Rating (RatingValue, DocumentID) VALUES ($rating, $id)");
                    }
                }
                ?>

                <form action="rate.php" method="get">
                    <input type="hidden" name="act" value="run">
                    <input type="submit" value="Submit" class="input">
                </form>
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