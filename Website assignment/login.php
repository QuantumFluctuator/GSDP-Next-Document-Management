<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
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
                <div class="container">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <button type="submit" onclick="location.href='index.php'">Login</button>
                    <label  style="color:#FFFFFF">
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn" onclick="location.href='index.php'">Cancel</button>
                </div>
            </form>

            <footer>
                <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
            </footer>
        </div>
    </body>
</html>
