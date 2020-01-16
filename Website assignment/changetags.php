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

            <div class="topnav">
                <form action="changetags.php" method="post" align="center">
                    <input type="text" name="search" placeholder="Search" />
                    <input type="submit" value="Go" />
                </form>
            </div>

            <?php
            $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
            //Collect
            if(isset($_POST['search'])) {
                $searchq = $_POST['search'];
                //Setting allowed characters, only numbers, letters and a small set of punctuation
                $searchq = preg_replace("#[^0-9 a-z . _ ]#i","",$searchq);

                //SQL query, comparing search string to column data
                $query = mysqli_query($connect, "SELECT DISTINCT * FROM documents d INNER JOIN TagLink l ON d.ID=l.ID INNER JOIN Tag t ON t.TagID=l.TagID WHERE (Name LIKE '%.doc' OR Name LIKE '%.docx' OR Name LIKE '%.txt') AND (t.TagName LIKE '%$searchq%')") or die ("Could not search.");

                $count = mysqli_num_rows($query);

                //if no matches to the search
                if($count == 0){
                    echo "<p class=noresults>There were no results for your search.</p><br>";

                }else{
            ?>
            <hr size="6" width="75%" align="center" color="black">
            <h2>Search Results</h2>
            <table class="bordered">
                <thead>
                    <tr>
                        <td>Document ID</td>
                        <td>Document Name</td>
                        <td>File Location</td>
                        <td>Last Edited</td>
                        <td>Author</td>
                        <td>Tags</td>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    //While loop to collect relevant information from the rows
                    while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
                        <td><?php echo $row['ID']?></td>
                        <td><?php echo "<a href=Documents/" . $row['Name'] . " download>" . $row['Name'] . "</a>"?></td>
                        <td><?php echo $row['Location']?></td>
                        <td><?php echo $row['LastModified']?></td>
                        <td><?php echo $row['Author']?></td>
                        <td>
                        <?php
                        $tags = mysqli_query($connect, "SELECT * FROM Tag JOIN TagLink ON Tag.TagID = TagLink.TagID WHERE TagLink.ID = " . $row['ID']);

                        while ($row1 = mysqli_fetch_assoc($tags)) {
                            echo str_ireplace($searchq, "<mark>" . $searchq . "</mark>", $row1['TagName'] . "<br>");
                        }
                        ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
                }   
            }
            ?>

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
                        $id= $_GET['DocID']; // saves description entered 
                        $tagid= $_GET['TagID'];
                        $insert = mysqli_query($connect, "INSERT INTO TagLink (ID, TagID) VALUES ($id, $tagid)");
                        if ($connect->query($insert) === TRUE) {
                            echo "<br>New tag added successfully";
                        }
                    }
                    ?>

                    <form action="changetags.php" method="get">
                        <input type="hidden" name="act" value="run">
                        <input type="submit" value="Submit" class="input">
                    </form>
                </form>
                <form>
                    <legend><h3>Delete Tags</h3></legend>
                    <label>Enter a document ID:</label>
                    <input type="text" name="DelDocID"/>
                    <label>Add a new tag ID:</label>
                    <input type="text" name="DelTagID"/>

                    <?php
                    if (!empty($_GET['del'])) {
                        $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
                        if (!$connect) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            die(mysqli_error());
                        }
                        $id= $_GET['DelDocID']; // saves description entered
                        $tagid= $_GET['DelTagID'];
                        $insert = mysqli_query($connect, "DELETE FROM TagLink WHERE (ID=$id AND TagID=$tagid)");
                        if ($connect->query($insert) === TRUE) {
                            echo "<br>Tag removed successfully";
                        }
                    }
                    ?>
                    <form action="changetags.php" method="get">
                        <input type="hidden" name="del" value="run">
                        <input class="adminbutton" type="submit" value="Delete" class="input">
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