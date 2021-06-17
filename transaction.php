<?php
include 'connection.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($con,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE customers set balance=$newbalance where id=$from";
                mysqli_query($con,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE customers set balance=$newbalance where id=$to";
                mysqli_query($con,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($con,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transaction_history.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tables.css">
    <title>Transaction</title>
    

  
</head>

<body>
 
 <?php
   include 'navbar.php';
   ?>
   <br><br>
   <div class="heading"><h1>Transaction</h1></div>
<br>
    <div class="container">
        
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customers where id=$sid";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($con);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div class="table_cost">
            <table class="table_cust" >
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        
      
        <div class="small_headings">
        <label >Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customers where id!=$sid";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($con);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            
        </select>

        <br>
        <br>
            <label>Amount:</label>
            <input type="number" class="amnt" name="amount" id="amt" required>  
            <br><br>
                <div class="text-center" >
            <button class="btn" name="submit" type="submit" id="myBtn">Transfer</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>



