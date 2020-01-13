<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
</head>
<body>
    <?php require_once 'process.php'; ?>
    <?php if (isset($_SESSION['message'])):?>

    <div class="alert alert-<?=$_SESSION['msg-type']?>">
    <?php 
    echo $_SESSION['message'];
    unset($_SESSION['message']);
     ?>
     </div>
     <?php endif ?>

    <div class="container">
    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'test') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM crud") or die($mysqli->error);
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th colspan="2">
                        Action
                    </th>
                </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()):  ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="crud.php?edit=<?php echo $row['id']; ?>" class="btn btn-outline-info">Edit</a>
                    <a href="crud.php?delete=<?php echo $row['id']; ?>" class="btn btn-outline-danger">delete</a>
                </td>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>
    
    <div class="row justify-content-center">
    <form action="process.php" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" id="" placeholder="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <?php if ($update == true): ?>
            <button type="submit" class="btn btn-outline-info" name="update">Update</button>
<?php else: ?>
        <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
        <?php endif ?>
        </div>
    </form>
    </div>
    </div>
</body>
</html>