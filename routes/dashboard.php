<?php
session_start();
if(!isset($_SESSION['userdata']))
{
   header("location: ../");
   exit;
}

$userdata = $_SESSION['userdata'];
$groupdata = $_SESSION['groupdata'];

if($_SESSION['userdata']['status']==0)
{
    $status = '<b style = "color:red">Not Voted</b>';
}
else
{
    $status = '<b style = "color:green">Voted</b>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting system - Dasboard</title>
    <link rel="stylesheet" href="../CSS/stylesheet.css">
</head>
<body>
     <style>
        #backbtn
        {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            float: left;
            margin: 10px;
        }
        #logoutbtn
        {
              padding: 5px;
              font-size: 15px;
              background-color: #3498db;
              color: white;
              border-radius: 5px;
              float: right;
              margin: 10px;
        }
        #Profile
        {
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }
        #Group
        {
            background-color: white;
            width: 60%;
            padding: 20px ;
            float: right;
        }
        #votebtn
        {
             padding: 5px;
              font-size: 15px;
              background-color: #3498db;
              color: white;
              border-radius: 5px;
             
        }
        #mainpanel
        {
          padding: 10px;   
        }
        #headerSection
        {
            padding: 10px;   
        }
        #voted
        {
            padding: 5px;
              font-size: 15px;
              background-color: green;
              color: white;
              border-radius: 5px;

        }
        
     </style>
     <div id="mainsection">
        <center>
         <div id= "headerSection">
         <a href="../">
             <button id="backbtn"> Back</button>
        </a>

         <a href="logout.php">
             <button id="backbtn">Logout</button>
        </a>
               <h1>Online Voting system</h1>     
         </div>
         </center>
         <hr>

         <div id="mainpanel">
         <div id="Profile">
          <center> <img src="../uploads/<?php echo $userdata['photo'] ?> " height="100" width="100"> </center> <br><br>
            <b>Name:</b> <?php echo $userdata['name'] ?><br><br>
            <b>Mobile: </b> <?php echo $userdata['mobile'] ?><br><br>
            <b>Address:</b> <?php echo $userdata['address'] ?><br><br>
            <b>Status:</b> <?php echo $status ?><br><br>
         </div>
          <div id="Group">
            <?php
            if($_SESSION['groupdata'])
            {
              for($i=0; $i<count($groupdata); $i++)
              {
                ?>
                 <div>
                    <img style="float: right;" src="../uploads/<?php echo $groupdata[$i]['photo']?>" height="70" width="70">
                   <b>Group Name: </b><?php echo $groupdata[$i]['name']?><br><br>
                   <b>Votes: </b><?php echo $groupdata[$i]['votes']?><br><br>
                   <form action="../api/vote.php/" method="POST">
                      <input type="hidden" name="gvotes" value="<?php echo $groupdata[$i]['votes'] ?>">
                      <input type="hidden" name="gid" value="<?php echo $groupdata[$i]['id'] ?>">
                      <?php
                      if($_SESSION['userdata']['status']==0)
                      {
                        ?>
                            <input type="submit" name="votebtn" value="vote" id="votebtn" >
                        <?php
                      }
                      else
                      {
                        ?>
                           <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                        <?php
                      }
                      ?>
                     
                   </form>
                   <hr>
                  </div> 
                <?php
              }
            }
            else
            {

            }
            ?>
          </div>
         </div>
    
       
 
     </div>

</body>
</html>
