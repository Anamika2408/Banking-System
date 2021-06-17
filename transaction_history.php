<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="tables.css">
   
    <title>Transaction History</title>
    </head>
<body>

<div>
  <?php
   include 'navbar.php';
   ?></div>
   <br><br>
  <div class="heading"> <h1 >Transaction History</h1></div>
	<div class="main">
        <br>
       <div class="table_cost">
    <table class="table_cust">
        <thead>
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
            </tr>
        </thead>
        <tbody>
		<?php       

            include 'connection.php';

            $sql ="select * from transaction";

            $query =mysqli_query($con, $sql);  
            ?>
			<?php
            while($rows = mysqli_fetch_assoc($query)){
      		?>
           
            <tr>
            <td class="py-2"><?php echo $rows['sno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2"><?php echo $rows['balance']; ?> </td>
            <td class="py-2"><?php echo $rows['datetime']; ?> </td>
               </tr>
       			<?php
                    }
                ?>
        </tbody>
    </table>

    </div>
</div>
</body>
</html>