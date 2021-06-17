<html>
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="tables.css">
    <title>Transfer Money</title>
 </head>
<body >
    <div>
    <?php
        include 'navbar.php';
    ?>
    </div>

    <?php
    include 'connection.php';
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($con,$sql);
    ?>
    <br><br>
    <div class="heading"><h1>Transfer Money</h1></div>
        <br><br>
        <div class="main">
                <table class="table_cust" >
                        <thead>
                            <tr>
                            <th scope="col" class="text-center py-2">Id</th>
                            <th scope="col" class="text-center py-2">Name</th>
                            <th scope="col" class="text-center py-2">E-Mail</th>
                            <th scope="col" class="text-center py-2">Balance</th>
                            <th scope="col" class="text-center py-2">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td class="py-2"><?php echo $rows['id'] ?></td>
                        <td class="py-2"><?php echo $rows['name']?></td>
                        <td class="py-2"><?php echo $rows['email']?></td>
                        <td class="py-2"><?php echo $rows['balance']?></td>
                        <td><a href="transaction.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="btn1">Transact</button></a></td> 
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