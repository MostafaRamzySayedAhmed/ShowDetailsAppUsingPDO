<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers, This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Items";
echo "<link rel='icon' href='images/cube.ico' type='image/x-icon'>";

if(isset($_SESSION['Username']))
	
   {
    
	    include "includes/templates/header.php";
	    include "includes/templates/navbar.php";
	   
        include "config.php";
    
        // Preparing The SQL Statement
    
	    $stmt = $conn->prepare("SELECT * FROM items");

        // Executing The Statement

        $stmt->execute();

        // Assigning To Variable 

        $rows = $stmt->fetchAll();
    
        // Getting The Count Of The Reterived Rows
    
        $count = $stmt->rowCount();

?>

<script>


function getDetails(id)
    
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
        //  console.log("Success");
      }
    };
        
    xmlhttp.open("GET","item.php?id=" + id ,true);
    xmlhttp.send();

}

</script>
				
<div class="container">
<h1 class="heading">Items</h1>
<p id='txtHint'></p>
<?php
                        if($count > 0)
                        {
                            
                            echo "<div class='row'>";

							foreach($rows as $row) 
							
							{
                                echo "<div class='item col-md-2'>";
                                
                                    $id = $row['id'];
									echo "<span class='name'>". $row['ItemName']. "</span>";
									
        echo "<span class='price'>". $row['ItemPrice']."<span class='dollar'> $</span>". "</span>";
                                    echo "<span class='country'>". $row['ItemCountry']. "</span>";
                                
                                ?>
    
    <a onclick="getDetails('<?php echo $id ?>')" class='btn btn-success'>Show Details</a>
                                
                                <?php echo "</div>";

							}
                            
                            echo "</div>";
?>
                            
</div>

<?php 
	
                        } else
                            {
                                echo "<div class='alert alert-danger'>There Are No Items</div>";
                            }
 } else
	
	{
		
		include "includes/templates/header.php";
		
		$user_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
		redirect_login($user_error, 5);
		
	}

include "includes/templates/fotter.php";
?>

<footer class="list container-fluid text-center">
  <ul>
      <li><a href="#" title="Facebook" class="pop fa fa-facebook"></a></li>
      <li><a href="#" title="Twitter" class="pop fa fa-twitter"></a></li>
      <li><a href="#" title="Linkedin" class="pop fa fa-linkedin"></a></li>
      <li><a href="#" title="Google+" class="pop fa fa-google-plus"></a></li>
  </ul>
    <p>Copyright <i class="fa fa-copyright"></i> 2020 All Right Reserved</p>
</footer>
<?php   
/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/