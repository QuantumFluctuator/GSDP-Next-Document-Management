<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit Tags</title>
        <link href="css/main.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <header>
                <div id="logo">
                    <h1><a href="index.php">NEXT DOCUMENT MANAGER</a></h1>
                </div>
            </header>


            <form>
                <fieldset>
                    <legend>Edit Tags:</legend>
                    <label>Enter a document ID:</label>
                    <p>
                        <input type="text" name="DocID"/>
                    </p>
                    <label>Add a new tag ID:</label>
                    <p>
                        <input type="text" name="TagID"/>
                    </p>

                    <!--<form action= "script.php" method = "get" >
                    <input type= "submit" value= "Submit" > -->

                    <?php
                    if (!empty($_GET['act'])) 
                    {
                        $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
                        if (!$connect) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            die(mysqli_error());
                        }
                        $id= $_GET['DocID']; // saves description enterd 
                        $tagid= $_GET['TagID'];
                        $insert = mysqli_query($connect, "INSERT INTO TagLink (ID, TagID) VALUES ($id, $tagid)");
                        if ($connect->query($insert) === TRUE) {
                            echo "<br>New tag added successfully";
                        }
                    } else {
                    ?>

                    <form action="changetags.php" method="get">
                        <input type="hidden" name="act" value="run">
                        <input type="submit" value="Submit">
                    </form>

                    <?php
                    }
                    ?>

                    <p><label>Tag ID:</label></p>
                    <p><label>1 Support</label></p>
                    <p><label>2 Architectural</label></p>
                    <p><label>3 User</label></p>
                    <p><label>4 Analysis</label></p>
                    <p><label>5 Design</label></p>
                    <p><label>6 Testing</label></p>
                    <p><label>7 Results</label></p>
                    <p><label>8 Framework</label></p>
                    <p><label>9 Planning</label></p>
                    <p><label>10 .docx</label></p>
                    <p><label>11 .doc</label></p>
                    <p><label>12 .txt</label></p>



                </fieldset>
            </form>
            <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>