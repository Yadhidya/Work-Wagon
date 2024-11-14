<html lang="en">

<head>
  <link rel="stylesheet" href="hom.css">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="pc_style.css">
  
 <link rel="stylesheet" href="productcardcss.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="new.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Work Wagon</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>

<body>
  <nav id="topnav" class="navabar" style="background-color:#FFFFFF;box-shadow:0px 0px 10px 0px black; position: fixed; top: 0; width:100%;z-index:1000;">
    <div class="logo-container" style="width:30%;">   
      <img src="logo1.png" class="logo">                                 
    </div>
  
    <div class="container" >
      <ul class="nav-items">
        <li><a href="description.html" id="home"><i class="fas fa-home" style="margin:4px;"></i>DESCRIPTION</a></li>
        <li><a href="blur.html" id="register"><i class="fas fa-user-plus" style="margin:4px;"></i>REGISTER</a></li>
        <?php
        session_start();
        if (isset($_SESSION['email'])) {
          echo '<li><a href="logout.php" id="logout"><i class="fas fa-sign-out-alt" style="margin:4px;"></i>LOGOUT</a></li>';
      }
       else {
            echo '<li><a href="index.php" id="login"><i class="fas fa-sign-in-alt" style="margin:4px;"></i>LOGIN</a></li>';
        }
        ?>
        
        
        <li><a href="profile.php" id="Profile"><i class="fas fa-user" style="margin:4px;"></i>PROFILE</a></li>
      </ul>
    
  

    
    <div class="hamburger-menu">
      <div class="hamburger-icon">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
    </div>
    </div>
  </nav>
  
 
  <div class="wrapper">

    <nav class="tabs">
      <div class="selector"></div>
      <a href="#" class="active" onclick="openTab(event, 'Tab1')"><i class="fas fa-shopping-cart"></i>SHOPS</a>
      <a href="#" onclick="openTab(event, 'Tab2')"><i class="fas fa-users"></i>WORKERS</a>

    </nav>
   </div>
  </div>
  
  <div id="Tab1" class="tabcontent active">
    <div style="margin-bottom:20px;" >
    <label for="cityFilter">Filter by City:</label>
    <select id="cityFilter" class="custom-select">
      
        <option value="all">All</option>
        <option value="kakinada">Kakinada</option>
        <option value="Nidadavole">Nidadavole</option>
    </select></div>
    
      <div id="restaurantList" class="city">
      <?php
function fetchshopData() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM shop_insert";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
     
            echo '<div class="innerdisplay" data-city="'.$row['shop_city'].'">';
            echo '<div class="first"><center><img src="images/' . $row['shop_image'] . '" alt="Worker Image"></center></div>';
            echo '<div class="second">';
            echo '<b class="card_name">Name</b>:<span class="cards_name">' . $row['shop_name'] . '</span><br>';
            echo '<b class="card_salary"> Salary</b>:<span class="cards_salary">' . $row['shop_salary'] . '</span><br>';
            echo'<b class="card_availa">Vacancies</b>:<span class="cards_availa">' . $row['shop_available'] . '</span><br>';
            echo '<center><button class="shopbutton">moreee..</button></center>';
            echo '</div></div>';
      
            
echo '<form action="shop_requests.php" method="post"><div class="popupcontainer">';
if (isset($_SESSION['worker_email'])) 
{
echo'<input type="text" name="shop_email" value="'.$row['shop_email'].'"><br>
<input type="hidden" name="worker_email" value="'.$_SESSION['worker_email'].'">';
}
echo '<div class="popup">';
echo '<main>';
echo '<div class="cardpr">';
echo '<div class="card__title">';
echo '<div class="icon">';
echo '<a  class="shopclosebutton"><i class="fa fa-close" style="margin-left:3px;"></i>  close</a>';
echo '</div>';
echo '<h3>SHOP</h3>';
echo '</div>';
echo '<div class="card__body">';
echo '<div class="half">';
echo '<div class="featured_text">';
echo '<h2>' . $row['shop_name'] . '</h2>';
echo '</div>';
echo '<div class="image">';
echo '<img src="images/' . $row['shop_image'] . '" alt="Worker Image">';
echo '</div>';
echo '</div>';
echo '<div class="half">';
echo '<div class="description">';
echo '<center>';
echo '<table>';
echo '<tr>';
echo '<td> Name</td><td>:</td><td>' . $row['shop_name'] . '</td></tr>';
echo '<tr>';
echo '<td style="width:80px;"> Job Name</td><td>:</td><td>' . $row['shop_job_name'] . ' </td></tr>';
echo '<tr>';
echo '<td> Shopkeeper Name</td><td>:</td><td>' . $row['shopkeeper_name'] . '</td></tr>';
echo '<tr>';
echo '<td> Vacancies</td><td>:</td><td class="avail1"> ' . $row['shop_available'] . '</td></tr>';
echo '<tr>';
echo '<td> Category</td><td>:</td><td> ' . $row['shop_category'] . '</td></tr>';
echo '<tr>';
echo '<td> Age required</td><td>:</td><td> ' . $row['shop_age_required'] . 'above</td></tr>';
echo '<tr>';
echo '<td>Timings</td><td>:</td><td>' . $row['time_in'] . '' . $row['time_in_ampm'] . 'to ' . $row['time_out'] . '' . $row['time_out_ampm'] . '</td></tr>';
echo '<tr>';
echo '<td> Salary</td><td>:</td><td> ' . $row['shop_salary'] . '</td></tr>';
echo '<tr>';
echo '<td> Requirements</td><td>:</td><td>' . $row['shop_requirements'] . '</td></tr>';
echo '<tr>';
echo '<td> Address</td><td>:</td><td>' . $row['shop_address'] . '</td></tr>';
echo '<tr>';
echo '<td>City</td><td>:</td><td>' . $row['shop_city'] . '</td></tr>';
echo '</table>';
echo '</center>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '<div class="card__footer">';
echo '<div class="recommend">';
echo '<p>Recommended by</p>';
echo '<h3>Admin of workwagon.in</h3>';
echo '</div>';

  if (isset($_SESSION['worker_email'])&& $row['shop_available']!= 0 && $_SESSION['worker_available'] != 'no' )
  {
  echo '<div class="shopreqbutton2" id="shopreqbutton">';
  echo '
  <div class="action"><button class="btn" type="submit">REQUEST</button></div>';
  echo '</div>';
}

echo '</div>';
echo '</div>';
echo '</main>';
echo '</div>';
echo '</div></form>';

        }
}else {
        echo "No worker data found.";
    
  }
    mysqli_close($conn);
}
fetchshopData();
?> 
         
      
       
          
      </div>
      </div>
      </div>
   

    
  <div id="Tab2" class="tabcontent">
     <div style="margin-bottom:20px;" >
    <label for="workerfilter">Filter by City:</label>
    <select id="workerfilter" class="custom-select">
      
        <option value="all">All</option>
        <option value="kakinada">Kakinada</option>
        <option value="Nidadavole">Nidadavole</option>
    </select></div>
    
      <div id="workerlist" class="city">
      
      <?php
function fetchWorkerData() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM worker_insert";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="innerdisplay" data-city="'.$row['worker_city'].'">';

            echo '<div class="first"><center><img src="images/' . $row['worker_image'] . '" alt="Worker Image"></center></div>';
            echo '<div class="second">';
            echo '<b class="card_name">Name</b>:<span class="cards_name">' . $row['worker_name'] . '</span><br>';
            echo '<b class="card_salary">Salary</b>:<span class="cards_salary">' . $row['worker_salary'] . '</span><br>';
            echo '<center><button class="morebutton">moreee..</button></center>';
            echo '</div></div>';
            
            echo '<form action="worker_requests.php" method="post"><div class="popup-container">';
            if (isset($_SESSION['shop_email'])) 
{
echo'<input type="text" name="worker_email" value="'.$row['worker_email'].'"><br>
<input type="hidden" name="shop_email" value="'.$_SESSION['shop_email'].'">';
}
            echo '<div class="popup">';
            echo '<div class="card">';
            echo '<div class="ds-top"><a class="closebutton" style="margin:3px;">Close</a></div>';
            echo '<div class="avatar-holder">';
            echo '<img src="images/' . $row['worker_image'] . '" alt="Worker Image">';
            echo '</div>';
            
            echo '<div class="name"><a  target="_blank">' . $row['worker_name'] . '</a></div>';
            echo '<div class="ds-info">';
            echo '<div class="ds pens">';
            echo '<h6 title="Number of pens created by the user">Available<i class="fas fa-edit"></i></h6>';
            echo '<p class="la">' . $row['worker_available'] . '</p>';
            echo '</div>';
            echo '<div class="ds projects">';
            echo '<h6 title="Number of projects created by the user">Work Known <i class="fas fa-project-diagram"></i></h6><br>';
            echo '<p class="le">' . $row['worker_work_known'] . '</p>';
            echo '</div>';
            echo '<div class="ds posts">';
            echo '<h6 title="Number of posts">City <i class="fas fa-comments"></i></h6><br>';
            echo '<p class="lw">' . $row['worker_city'] . '</p>';
            echo '</div>
            <div class="ds posts">
            <h6 title="Number of posts">Salary<i class="fas fa-comments"></i></h6><br>
            <p class="lr">' .$row['worker_salary']. '</p>
          </div>';
            echo '</div>';

            if (isset($_SESSION['shop_email'])&& $row['worker_available']==='yes' && $_SESSION['shop_available']!= 0 ) {
                echo '<div class="reqbutton2" id="reqbutton">';
                echo '<button class="btn" type="submit">REQUEST</button>';
                echo '</div>';
            }
          
            echo '</div>';
            echo '</div>';
            echo '</div></form>';
        
           }} else {
        echo "No worker data found.";
    }

    // Close the database connection
    mysqli_close($conn);
}
fetchWorkerData();
?>
  </div> 
  
       
</div>



    
     
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>
  <div class="overlay"></div>
<div class="sidebar">
  <div class="sidebar-content">
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
      <ul class="nav sidebar-nav">
        <div class="sidebar-header">
          <div class="sidebar-brand">
            <button class="close-button" id="closeSidebar">Close</button>
          </div>
        </div>
        <ul>
      <div> <?php
         if(isset($_SESSION['shop_email'])) {
            echo '<li><a href="side_profile.php">Profile</a></li>';
          } elseif(isset($_SESSION['worker_email'])) {
            echo '<li><a href="side_profile1.php">Profile</a></li>';
          } else {
            echo '<li><a href="#">Profile</a></li>';
          }
          ?></div>
         
          <?php
           if(isset($_SESSION['shop_email'])) {
            echo '<li><a href="shop_requests_received.php">Requested</a></li>';
          } elseif(isset($_SESSION['worker_email'])) {
            echo '<li><a href="worker_requests_received.php ">Requested</a></li>';
          } else {
            echo '<li><a href="#">Requested</a></li>';
          }
          ?>
             
          <?php
           if(isset($_SESSION['shop_email'])) {
            echo '<li><a href="shop_replies_received.php">Replies</a></li>';
          } elseif(isset($_SESSION['worker_email'])) {
            echo '<li><a href="worker_replies_received.php ">Replies</a></li>';
          } else {
            echo '<li><a href="#">Replies</a></li>';
          }
          ?>
        </ul>
        <center>
  <div class="button-container" style="padding: 0px; text-align: center;">
    <?php
    if (isset($_SESSION['shop_email']) || isset($_SESSION['worker_email'])) {
      // If the user is logged in, display the "Logout" button
      echo '<a  id="log" href="logout_shoporworker.php">Logout</a>';
    } else {
      // If the user is not logged in, display the "Login as" buttons
      echo '<button id="loginButton">Login as</button>
           <div id="buttonContainer" class="hidden">
             <center><div style=" width:80px; background-color:rgb(60, 239, 60) ;"><a href="shoplogin.php"  id="shop1button" >Shop Keeper</a></div></center>
             <div style="margin-top: 10px;"></div> <!-- Add vertical space here -->
             <center><div style=" width:80px; background-color:rgb(60, 239, 60) ;"><a id="worker1button" href="sidebar_loginworker.php">WORKER</a></div></center>
           </div>';
    }
    ?>
  </div>
</center>

      </nav>
    </div>
  </div>
</div>

  


    </body>
</html>
   