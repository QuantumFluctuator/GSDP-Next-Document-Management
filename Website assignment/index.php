<!doctype html>
<html>

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

            <!--Button to take user to login form !-->
            <button type="submit" onclick="location.href='login.php' ">Sign in</button>


        <?php
        //Collect
        if(isset($_POST['search'])) {
            $searchq = $_POST['search'];
            //Setting allowed characters, only numbers, letters and a small set of punctuation
            $searchq = preg_replace("#[^0-9 a-z . _ ]#i","",$searchq);

            //SQL query, comparing search string to column data
            $query = mysql_query("SELECT * FROM documents WHERE ID LIKE '%$searchq%' OR Name LIKE '%$searchq%' OR Location LIKE '%$searchq%' Or LastModified LIKE '%$searchq%' Or Rating LIKE '%$searchq%' Or Author LIKE '%$searchq%'") or die ("Could not search.");

            //if no matches to the search
            if($count == 0){
                $output = 'There were no results for your search.';

            }else{
                //While loop to collect relevant information from the rows
                while($row = mysql_fetch_array($query)){
                    $docID = $row['ID'];
                    $docName = $row['Name'];
                    $loc = $row['Location'];
                    $moddate = $row['LastModified'];
                    $rated = $row['Rating'];
                    $author = $row['Author'];

                    $output .= '<div>'.$docID.' '.$docName.' '.$loc.' '.$moddate.' '.$rated.' '.$author.'</div>';

                }
            }   
        }
        }
        ?>

        <div class="topnav">
            <form action="index.php" method="post">
                <input type="text" name="search" placeholder="Search" />
                <input type="submit" value="Go" />
            </form>


        <?php // outputting search results on button click
        print("$output");?>

        </div>




            <hr size="6" width="75%" align="left" color="black">

            <table>
                <thead>
                    <tr>
                        <td>Document ID</td>
                        <td>File Location</td>
                        <td>Document Name</td>
                        <td>Last Edited</td>
                        <td>Rating</td>
                        <td>Author</td>
                        <td>Tags</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");
                    if (!$connect) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        die(mysqli_error());
                    }
                    
                    $results = mysqli_query($connect, "SELECT * FROM documents");
                    
                    if (!$results) {
                        $message  = 'Invalid query: ' . mysqli_error() . "\n";
                        die($message);
                    }
                    
                    while($row = mysqli_fetch_assoc($results)) {
                    ?>
                        <tr>
                            <td><?php echo $row['ID']?></td>
                            <td><?php echo $row['Location']?></td>
                            <td><?php echo "<a href=Documents/" . str_replace(' ', '%20', $row['Location']) . str_replace(' ', '%20', $row['Name']) . " download>" . $row['Name'] . "</a>"?></td>
                            <td><?php echo $row['LastModified']?></td>
                            <td><?php echo $row['Rating']?></td>
                            <td><?php echo $row['Author']?></td>
                            <td></td>
                        </tr>
                        
                </tbody>
            </table>
            <footer>
                    <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>
