<?php
include '../php/functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');

    // Handle image upload
    $image = ''; // Default value for image path
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_dir = 'uploads/'; // Directory to store uploaded images
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image = $image_dir . $image_name;
        // Move the uploaded file to the 'uploads' directory
    if (!move_uploaded_file($image_tmp, $image)) {
        // If moving the file fails, handle the error
        echo 'Failed to move uploaded file.';
    }
}

    try {
        // Modify the SQL query to include the 'image' column
        $stmt = $pdo->prepare('INSERT INTO contacts (name, email, phone, title, created, image) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$name, $email, $phone, $title, $created, $image]);
        $msg = 'Created Successfully!';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage(); // Output any PDO exceptions for debugging
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?=template_header('testc')?>

<div class="content update">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Contact</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Create Contact
                    </div>
                    <div class="card-body">
                        <form action="testc.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="johndoe@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="2025550143">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Employee">
                            </div>
                            <div class="form-group">
                                <label for="created">Created</label>
                                <input type="datetime-local" name="created" class="form-control" value="<?=date('Y-m-d\TH:i')?>">
                            </div>
                            <!-- Input field for image upload -->
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>
                            <button type="submit" value="testc" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                    <?php if ($msg): ?>
                    <div class="card-footer">
                        <p><?=$msg?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-t58V21v1W7vZnAHeSwzrz3ndvn3l8h27lSngfCf0o1z4yF6EPv1xWJgLT7Dv6l1X"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shCk+5L4Zj5u6zXHhT/n/xOenlO+mN5O7ftD"
        crossorigin="anonymous"></script>
</body>

</html>
