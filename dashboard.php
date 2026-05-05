<?php 
    session_start();

    if(!isset($_SESSION["email"])) {
        header("Location: index.php?message=Please login first");
        exit;
    }

    $email = $_SESSION["email"];
    $image = $_SESSION['image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin:0; padding:0;">
   <div style="
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:15px 25px;
        background:linear-gradient(135deg,#6a11cb,#2575fc);
        color:#fff;
        box-shadow:0 4px 12px rgba(0,0,0,0.15);
        font-family:Arial, sans-serif;
    ">

        <!-- LEFT: LOGO / BRAND -->
        <div style="font-weight:bold; font-size:16px;">
            Dashboard
        </div>

        <!-- RIGHT: USER INFO -->
        <div style="display:flex; align-items:center; gap:10px;">

            <?php if ($image): ?>
                <img src="uploads/<?php echo $image; ?>" 
                    alt="User Image"
                    style="
                        width:40px;
                        height:40px;
                        object-fit:cover;
                        border-radius:50%;
                        border:2px solid #fff;
                        box-shadow:0 2px 8px rgba(0,0,0,0.2);
                    ">
            <?php else: ?>
                <div style="
                    width:40px;
                    height:40px;
                    border-radius:50%;
                    background:rgba(255,255,255,0.3);
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:10px;
                    text-align:center;
                ">
                    No Img
                </div>
            <?php endif; ?>

            <div style="display:flex; flex-direction:column; line-height:1.2;">
                <span style="font-size:13px; opacity:0.9;">Welcome</span>
                <span style="font-weight:bold; font-size:14px;">
                    <?php echo htmlspecialchars($email); ?>
                </span>
            </div>

        </div>
    </div>
</body>
</html>