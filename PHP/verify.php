<?php
require_once'../PHP/connecttesting.php';

if(isset($_GET['email']) && isset($_GET['v_code']))
{
    $query = "SELECT * FROM `user` WHERE `email` = '$_GET[email]' AND `verification_code` = '$_GET[v_code]' ";
    $result = mysqli_query($con, $query);
    if($result)
    {
        if(mysqli_num_rows($result) == 1)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['is_verified'] == 0)
            {
                $update = "UPDATE `user` SET `is_verified` = 1 WHERE `email` ='$result_fetch[email]' ";
                if(mysqli_query($con,$update))
                {
                    echo"
                    <script>
                    alert('Email đã xác thực thành công');
                    window.location.href = '../Html/sign-up.html';
                    </script>
                    ";
                }
                else
                {
                    echo"
                    <script>
                    alert('Khong the truy van');
                    window.location.href = '../Html/sign-up.html';
                    </script>
                    ";
                }
            }
            else
            {
                echo"
                <script>
                alert('Email đã đăng ký');
                window.location.href = '../Html/sign-up.html';
                </script>
                ";

            }
        }
    }
    else
    {

        echo"
        <script>
        alert('khong the truy van');
        window.location.href = '../Html/sign-up.html';
        </script>
        ";
    }
}
?>