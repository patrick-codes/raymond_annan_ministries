<?php
include '../raymond_annan_ministries/php/functions.php';

// Connect to the database
$pdo = pdo_connect_mysql();

// Pagination logic
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

// Get total number of contacts
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();

// Calculate the total number of pages
$total_pages = ceil($num_contacts / $records_per_page);

// Ensure that the current page is within the valid range
$page = max(1, min($page, $total_pages));

// Calculate the offset for the SQL query
$offset = ($page - 1) * $records_per_page;

// Fetch contacts data for the current page
$stmt = $pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :offset, :records_per_page');
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Read')?>

<div class="content read">
    <h2>Read Contacts</h2>
    <a href="testc.php" class="create-contact">Create Contact</a>

    <div class="row mt-3">
        <?php foreach ($contacts as $contact): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    
                <?php if ($contact['image']): ?>
                        <img src="<?=$contact['image']?>" class="card-img-top" alt="Contact Image">
                    <?php else: ?>
                        <img src="default_image.jpg" class="card-img-top" alt="Default Image">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?=$contact['name']?></h5>
                        <p class="card-text">Email: <?=$contact['email']?></p>
                        <p class="card-text">Phone: <?=$contact['phone']?></p>
                        <p class="card-text">Title: <?=$contact['title']?></p>
                        <p class="card-text">Created: <?=$contact['created']?></p>
                        <div class="actions">
                            <a href="update.php?id=<?=$contact['id']?>" class="btn btn-primary">Edit</a>
                            <a href="delete.php?id=<?=$contact['id']?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination mt-4">
        <?php if ($page > 1): ?>
            <a href="testr.php?page=<?=$page-1?>" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> Previous</a>
        <?php endif; ?>
        <?php if ($page < $total_pages): ?>
            <a href="testr.php?page=<?=$page+1?>" class="btn btn-secondary ml-2">Next <i class="fas fa-angle-double-right"></i></a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
