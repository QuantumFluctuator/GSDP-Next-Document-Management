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

            <div class="bordered">
                <form>
                    <legend><h3>Edit Tags</h3></legend>
                    <label>Enter a document ID:</label>
                    <input type="text" name="DocID"/>
                    <label>Add a new tag ID:</label>
                    <input type="text" name="TagID"/>

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
                    }


                    if (!empty($_GET['del'])) 
                    {
                        $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
                        if (!$connect) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            die(mysqli_error());
                        }
                        $delid= $_GET['DocID']; // saves description enterd 
                        $deltagid= $_GET['TagID'];
                        $insert = mysqli_query($connect, "DELETE FROM TagLink WHERE (ID=$delid AND TagID=$deltagid)");
                        if ($connect->query($insert) === TRUE) {
                            echo "<br>New tag added successfully";
                        }
                    }


                    ?>

                    <form action="changetags.php" method="get">
                        <input type="hidden" name="act" value="run">
                        <input type="submit" value="Submit" class="input">
                    </form>

                     <form action="changetags.php" method="get">
                        <input type="hidden" name="del" value="run">
                        <input type="submit" value="Delete" class="input">
                    </form>

                </form>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
                        $results = mysqli_query($connect, "SELECT * FROM Tag") or die ("could not connect");
                        while($row = mysqli_fetch_assoc($results)) {
                            echo "<tr>";
                            echo "<td>".$row['TagID']."</td>";
                            echo "<td>".$row['TagName']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class=container>
                <button class="cancelbtn" type="submit" onclick="location.href='index.php' ">Back</button>
            </div>
            <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>