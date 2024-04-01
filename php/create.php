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

   $image = ''; 
   if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
       $image_dir = 'uploads/';
       $image_name = $_FILES['image']['name'];
       $image_tmp = $_FILES['image']['tmp_name'];
       $image = $image_dir . $image_name;
   if (!move_uploaded_file($image_tmp, $image)) {
       echo 'Failed to move uploaded file.';
   }
   }

   try {
      
       $stmt = $pdo->prepare('INSERT INTO contacts (name, email, phone, title, created, image) VALUES (?, ?, ?, ?, ?, ?)');
       $stmt->execute([$name, $email, $phone, $title, $created, $image]);
       $msg = 'Created Successfully!';
   } catch (PDOException $e) {
       echo 'Error: ' . $e->getMessage(); 
   }
}
?>



<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="title" placeholder="Employee" id="title">
        <input type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i') ?>" id="created">
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
        <p>
            <?= $msg ?>
        </p>
    <?php endif; ?>
</div>

<?= template_footer() ?>