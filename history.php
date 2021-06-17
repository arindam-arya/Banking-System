<?php
    include 'db.php';

    $sql="select * from history order by time desc";
    $que=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - ABC Bank</title>
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
                    <li><a href="transfer.php" class="links">Transfer</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h2>Transaction History</h2>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($list=mysqli_fetch_assoc($que)){
                        echo "<tr>";
                        echo "<td>" .$list['sender']."</td>";
                        echo "<td>" .$list['receiver'] . "</td>";
                        echo "<td>" .$list['amt']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>