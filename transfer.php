<?php
    include 'db.php';

    $sql="select * from custom";
    $que=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer - ABC Bank</title>
    <link rel="shortcut icon" href="img/bank.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <div>
                <p class="inline"><a href="index.html" class="links">ABC Bank</a></p>
                <ul>
                    <li><a href="index.html" class="links">Home</a></li>
                    <li><a href="view.php" class="links">View</a></li>
                    <li><a href="history.php" class="links">History</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Name</th>
                        <th>Account Number</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($list=mysqli_fetch_assoc($que)){
                        echo "<tr>";
                        echo "<td>" .$list['s_no']."</td>";
                        echo "<td>" .$list['name'] . "</td>";
                        echo "<td>" .$list['acc_no']."</td>";
                        echo "<td>" .$list['balance']."</td>";
                        echo "<td> <form id='myform' action='trans.php' method='get'><button type='submit' class='btn' name='sender' value='".$list['s_no']."'>Select</button></form></td>";                        
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>