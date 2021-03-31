<?php
	session_start();

    if(!isset($_SESSION["name"] ) )
    header("location:login.html");

    $name=$_SESSION["name"];

    $servername = "localhost";
    $username = "abhinavG";
    $password = "Ag@12nitk201"; 
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if(!$conn)
      echo "connection failed";
    else
    {
        mysqli_select_db($conn,'canteen');
       
	$q="select name,quantity ,status,price
     from ( item inner join Food_List on item.item_id =Food_List.item_id )
      inner join Orders 
      on item.item_id =Orders.item_id  
      where
      Orders.username
      ='$name' ";

	
	
	$result=mysqli_query($conn,$q);

        $num=mysqli_num_rows($result);            
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <style>
        /* Dropdown Button */
        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /* Dropdown button on hover & focus */
        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #2980B9;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd
        }

        /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
        .show {
            display: block;
        }

        #hist-tr {
            background-color: whitesmoke;
        }
    </style>

    <script>
        /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

</head>

<body>
<table style="width: 100%; background-color: rgb(227, 240, 182);">
    <tr>
      <th align="left"><img src="restorant_logo.png" alt="Logo" width="100px" height="100px " ; /> </td>
     
      <th align="left"><a href="/menu.php" class="i202">Menu</a></td>
      
      
      <th align="center">
        <div class="dropdown">
          <button onclick="myFunction()" class="dropbtn">Hello
            <?php
                                                                
           echo $_SESSION["name"];
            ?>
          </button>
          <div id="myDropdown" class="dropdown-content">
            
            <a href="demo.php">Cart</a>
            <a href="history.php">history</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </th>

    </tr>
  </table>
    <div style="margin:150px">
        <h1>History</h1>
        <table style="border-style: solid; border-color: black; width: 100%;">
            <tr style="background-color: yellow;">
                <th>Name</th>
                <th>Price</th>
                <th>quantity</th>
                <th>Status</th>
            </tr>

            <?php
            for($i=1;$i<=$num;$i++)
            {
                $row=mysqli_fetch_array($result);
           
            ?>
            <tr class="hist-tr">
                <td align="center">
                    <?php echo isset($row["name"]) ? $row["name"]: "NULL"; ?>
                </td>
                <td align="center">
                    <?php echo $row["price"]; ?>
                </td>
                <td align="center">
                    <?php echo $row["quantity"] ?>
                </td>
                <td align="center">
                    <?php echo $row['status'] ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>

</body>

</html>
<?php
    }
?>