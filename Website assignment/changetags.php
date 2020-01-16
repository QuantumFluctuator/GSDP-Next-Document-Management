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
                    }
                    ?>

                    <form action="changetags.php" method="get">
                        <input type="hidden" name="act" value="run">
                        <input type="submit" value="Submit" class="input">
                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tag</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Support</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Architectural</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>User</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Analysis</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Design</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Testing</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Results</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Framework</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Planning</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>.docx</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>.doc</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>.txt</td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </form>
            <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>