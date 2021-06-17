<?php
    include_once 'db.php';
    $from=$_GET['sender'];
    if(isset($_POST['submit']))
    {
        $to=$_POST['to'];
        $amt=$_POST['amt'];
        
        $sql="select * from custom where s_no=$from";
        $que=mysqli_query($conn,$sql);
        $sender=mysqli_fetch_assoc($que);

        $sql="select * from custom where s_no=$to";
        $que=mysqli_query($conn,$sql);
        $receiver=mysqli_fetch_assoc($que);

        if($amt>$sender['balance']){
            echo "<script>alert('Insufficient Balance')</script>";
        }
        elseif($amt==0){
            echo "<script>alert('Amount Cannot be 0')</script>";
        }
        else{
            $temp=$sender['balance']-$amt;
            $sql="update custom set balance=$temp where s_no=$from";
            $minus=mysqli_query($conn,$sql);

            $temp=$receiver['balance']+$amt;
            $sql="update custom set balance=$temp where s_no=$to";
            $add=mysqli_query($conn,$sql);

            $sender_name=$sender['name'];
            $receiver_name=$receiver['name'];
            $sql="INSERT INTO `history` (`sender`, `receiver`, `amt`, `time`) VALUES ('$sender_name', '$receiver_name', '$amt', current_timestamp())";
            $up=mysqli_query($conn,$sql);

            if($minus==true && $add==true && $up==true)
            {
                echo "<script>alert('Transaction Successfull');window.location='history.php'</script>";
            }
        }
    }
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
        <div class="s_user">
        <table>
                <thead>
                    <tr>
                        <th>Selected User</th>
                        <th>Account Number</th>
                        <th>Available Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql='select * from custom where s_no='.$from;
                        $que=mysqli_query($conn,$sql);
                        while($list=mysqli_fetch_assoc($que)){
                        echo "<tr>";
                        echo "<td>" .$list['name'] . "</td>";
                        echo "<td>" .$list['acc_no']."</td>";
                        echo "<td>" .$list['balance']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <form method="post" name="receiver" class="tform">
            <label for="to" class="item">Transfer To:</label>
            <select name="to" class="item_" required>
                <option value="" disabled>Select</option>
                <?php
                    $sql='select * from custom where s_no!='.$from;
                    $que=mysqli_query($conn,$sql);
                    while($list=mysqli_fetch_assoc($que)){
                        echo "<option value='".$list['s_no']."'>".$list['name']."   :   ".$list['balance']."</option>";
                    }
                ?>
            </select>
            <label for="amt" class="item">Amount</label>
            <input type="number" name="amt"  class="item" required oninput="this.value=!!this.value&&Math.abs(this.value)>=0?Math.abs(this.value):null">
            <button type="submit" name="submit" class="tbtn">Transfer</button>
        </form>
    </div>
</main>
</body>

</html>