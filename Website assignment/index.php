<!doctype html>
<html>
    <?php
    $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");

    if (!$connect) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die(mysqli_error());
    }
    ?>
    <head>
        <meta charset="utf-8">
        <title>NEXT Document Manager</title>
        <link href="css/main.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div id="container">

            <header>
                    <div id="logo">
                        <h1><a href="index.php">NEXT DOCUMENT MANAGER</a></h1>
                    </div>
            </header>

            <div class = "buttons">
                <!--Button to take user to login form !-->
                <button type="submit" onclick="location.href='contact-me.html' ">Sign in</button>

                 <div class = "upload">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <!--Select image to upload: !-->
                        <button type="file" name="fileToUpload" id="fileToUpload"> Upload Document </button>

                    </form>
                </div>
            </div>
        </div>
            
        <div class="topnav">
            <form action="index.php" method="post" align="center">
                <input type="text" name="search" placeholder="Search" />
                <input type="submit" value="Go" />
            </form>


            <?php // outputting search results on vutton click
            print("$output");
            ?>
        </div>

        <?php
        //Collect
        if(isset($_POST['search'])) {
            $searchq = $_POST['search'];
            //Setting allowed characters, only numbers, letters and a small set of punctuation
            $searchq = preg_replace("#[^0-9 a-z . _ ]#i","",$searchq);

            //SQL query, comparing search string to column data
            $query = mysqli_query($connect, "SELECT * FROM documents WHERE (Name LIKE '%.doc' OR Name LIKE '%.docx' OR Name LIKE '%.txt') AND (Name LIKE '%$searchq%' OR ID LIKE '%$searchq%' OR Location LIKE '%$searchq%' OR LastModified LIKE '%$searchq%' OR Rating LIKE '%$searchq%' OR Author LIKE '%$searchq%')"); // ID LIKE '%$searchq%' OR Name LIKE '%$searchq%' OR Location LIKE '%$searchq%' OR LastModified LIKE '%$searchq%' OR Rating LIKE '%$searchq%' OR Author LIKE '%$searchq%'");// or die ("Could not search.");

            $count = mysqli_num_rows($query);
            
            //if no matches to the search
            if($count == 0){
                $output = 'There were no results for your search.';

            }else{
            ?>
            <hr size="6" width="100%" align="center" color="black">
            <h2>Search Results</h2>
            <table>
                <thead>
                    <tr>
                        <td>Document ID</td>
                        <td>Document Name</td>
                        <td>File Location</td>
                        <td>Last Edited</td>
                        <td>Rating</td>
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
                            <td><?php echo str_ireplace($searchq, "<mark>" . $searchq . "</mark>", $row['ID'])?></td>
                            <td><?php echo "<a href=Documents/" . str_replace(' ', '%20', $row['Location']) . str_ireplace(' ', '%20', $row['Name']) . " download>" . str_ireplace($searchq, "<mark>" . $searchq . "</mark>", $row['Name']) . "</a>"?></td>
                            <td><?php echo str_ireplace($searchq, "<mark>" . $searchq . "</mark>", $row['Location'])?></td>
                            <td><?php echo str_ireplace($searchq, "<mark>" . $searchq . "</mark>", $row['LastModified'])?></td>
                            <td><?php echo str_ireplace($searchq, "<mark>" . $searchq . "</mark>", $row['Rating'])?></td>
                            <td><?php echo str_ireplace($searchq, "<mark>" . $searchq . "</mark>", $row['Author'])?></td>
                            <td></td>
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
        <hr size="6" width="100%" align="center" color="black">
        <h2>All Documents</h2>
        <table>
            <thead>
                <tr>
                    <td>Document ID</td>
                    <td>Document Name</td>
                    <td>File Location</td>
                    <td>Last Edited</td>
                    <td>Rating</td>
                    <td>Author</td>
                    <td>Tags</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $results = mysqli_query($connect, "SELECT * FROM documents WHERE Name LIKE '%.doc' OR Name LIKE '%.docx' OR Name LIKE '%.txt'");

                if (!$results) {
                    $message  = 'Invalid query: ' . mysqli_error() . "\n";
                    die($message);
                }

                while($row = mysqli_fetch_assoc($results)) {
                ?>
                    <tr>
                        <td><?php echo $row['ID']?></td>
                        <td><?php echo "<a href=Documents/" . str_replace(' ', '%20', $row['Location']) . str_replace(' ', '%20', $row['Name']) . " download>" . $row['Name'] . "</a>"?></td>
                        <td><?php echo $row['Location']?></td>
                        <td><?php echo $row['LastModified']?></td>
                        <td><?php echo $row['Rating']?></td>
                        <td><?php echo $row['Author']?></td>
                        <td></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <hr size="6" width="100%" align="center" color="black">

        <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
        </footer>
    </body>
</html>
