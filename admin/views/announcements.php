<?php include 'header.php'; ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background-color: #f8f9fa;
    color: #333;
}

.container-md {
    max-width: 900px;
    margin: auto;
    padding: 20px;
}

.panel {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
}

.panel-body {
    padding: 20px;
}

h2 {
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    font-weight: 500;
    display: block;
    margin-bottom: 5px;
}

.form-control {
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

select.form-control {
    cursor: pointer;
}

textarea.form-control {
    min-height: 100px;
}

input[type="color"].form-control {
    height: 40px;
    padding: 5px;
}

.btn {
    display: inline-block;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
    transition: 0.3s;
}

.w-100 {
    width: 100%;
}

.input-group {
    display: flex;
    gap: 10px;
}

.add-custom-path-button {
    background: linear-gradient(145deg, #007bff, #0056b3); /* Gradient background for a sleek look */
    color: #ffffff; /* Text color */
    padding: 14px 28px; /* Padding for a more prominent button */
    font-size: 14px; /* Font size */
    font-weight: 500; /* Font weight */
    border: none; /* Remove default border */
    border-radius: 5px; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
.add-custom-path-button:hover {
    color: #ffffff; /* Text color */
    background: linear-gradient(145deg, #0056b3, #004085); /* Darker gradient on hover */
    transform: translateY(-2px); /* Slight lift effect */
}
.btn-primary {
    background: linear-gradient(145deg, #007bff, #0056b3); /* Gradient background for a sleek look */
    color: #ffffff; /* Text color */
    padding: 14px 28px; /* Padding for a more prominent button */
    font-size: 14px; /* Font size */
    font-weight: 500; /* Font weight */
    border: none; /* Remove default border */
    border-radius: 5px; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
.btn-primary:hover {
    color: #ffffff; /* Text color */
    background: linear-gradient(145deg, #0056b3, #004085); /* Darker gradient on hover */
    transform: translateY(-2px); /* Slight lift effect */
}
div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
    background: linear-gradient(145deg, #007bff, #0056b3) !important; /* Gradient background for a sleek look */
    color: #ffffff !important; /* Text color */
    padding: 14px 28px !important; /* Padding for a more prominent button */
    font-size: 14px !important; /* Font size */
    font-weight: 500 !important; /* Font weight */
    border: none !important; /* Remove default border */
    border-radius: 5px !important; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important; /* Subtle shadow for depth */
    transition: background 0.3s ease, transform 0.2s ease !important; /* Smooth transition for hover effects */
}
div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
    background: linear-gradient(145deg, #c71f1f, #e04d4d) !important; /* Gradient background for a professional look */
    color: #ffffff !important; /* Text color */
    padding: 14px 28px !important;
    font-size: 14px !important; /* Font size */
    font-weight: 500 !important; /* Font weight */
    border: none !important; /* Remove default border */
    border-radius: 5px !important; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3) !important; /* Subtle shadow for depth */
    transition: background 0.3s ease, transform 0.2s ease !important; /* Smooth transition for hover effects */
}
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

.table th {
    background-color: #f1f1f1;
    font-weight: 600;
}

.alert {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
/* Th */
.order-table tr th {
    text-transform: uppercase;
    text-align: center;
}

/* Table Data */
.order-table tr td {
    text-align: center;
}

/* Button */
.order-table tr .btn-warning {
    background-image: none;
    color: #5a5a5a;
    box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0);
}

/* Button */
.order-table tr .btn-danger {
    background-color: rgba(217, 4, 41, 0);
    color: #c0392b;
}
/* Button */
.order-table tr .btn-warning {
    background-color: rgba(240, 173, 78, 0);
}
.container-md .form-control .dropdown-toggle {
    background-color: rgba(255, 255, 255, 0);
    top: 5px;
    box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0) inset;
}
</style><style>
.log-menu {
   padding-left: 0;
   margin: 0;
}

.log-menu li {
   list-style: none;
   padding: 10px 15px;
   font-weight: 400;
   color: #337ab7;
   border-radius: 6px;
   margin-bottom: 5px;
   transition: background 0.2s;
}

.log-menu li.active {
   background-color: #e0e0e0;
   color: #000;
}

.log-menu li a {
   color: inherit;
   text-decoration: none;
   display: block;
}
</style>


<?php
include_once(__DIR__ . '/../../../app/config.php');
$servername = $config["db"]["host"];
$username   = $config["db"]["user"];
$password   = $config["db"]["pass"];
$database   = $config["db"]["name"];

$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4"); // Fix emoji saving issue

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertMessage = '';  // Variable for success or error messages

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM news WHERE id=$id");
    $alertMessage = "<div class='alert alert-success'>Announcement deleted successfully.</div>";
}

// Fetch News for History Card
$result = $conn->query("SELECT * FROM news ORDER BY id DESC");

// Handle Form Submission (Add or Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'];
    $description = $_POST['description'];

    if ($id) {
        // Update News with current date & time
        $stmt = $conn->prepare("UPDATE news SET news_title=?, news_content=?, news_date=NOW() WHERE id=?");
        $stmt->bind_param("ssi", $title, $description, $id);
        if ($stmt->execute()) {
            $alertMessage = "<div class='alert alert-success'>Announcement updated successfully.</div>";
        } else {
            $alertMessage = "<div class='alert alert-danger'>Error updating announcement. Please try again.</div>";
        }
    } else {
        // Insert New News with current date & time
        $stmt = $conn->prepare("INSERT INTO news (news_title, news_content, news_date) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $description);
        if ($stmt->execute()) {
            $alertMessage = "<div class='alert alert-success'>Announcement added successfully.</div>";
        } else {
            $alertMessage = "<div class='alert alert-danger'>Error adding announcement. Please try again.</div>";
        }
    }
}

// Fetch News for Editing
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editData = $conn->query("SELECT * FROM news WHERE id=$id")->fetch_assoc();
}
?>

<div class="container container-md">
      <ul class="log-menu">
   <li>
     <a href="<?php echo site_url("$rentaladmin/broadcasts") ?>">Broadcasts</a>



   </li>
   <li class="active">
     <a href="<?php echo site_url("$rentaladmin/announcements") ?>">Announcements</a>
   </li>
   
</ul><br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="text-center"><?= isset($editData) ? "Edit News" : "Create News" ?></h2>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?= $editData['news_title'] ?? '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea id="summernote" name="description" class="form-control"><?= $editData['news_content'] ?? '' ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100"><?= isset($editData) ? "Update News" : "Create News" ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table order-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    
                                    <th>Date & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['news_title']) ?></td>
                                        
                                        <td><?= date('d-m-Y h:i A', strtotime($row['news_date'])) ?></td>
                                        
                                        <td>
                                            <a href="<?php echo $settings['oldadminname']; ?>/announcements?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['id'] ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?= $alertMessage ?? '' ?>
            </div>
        </div>
    </div>
</div>

<!-- Auto Open Modal if Message Exists -->
<?php if (!empty($alertMessage)): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#alertModal').modal('show');
        });
    </script>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Handle delete button click event
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault(); // Prevent the default link action
        const newsId = $(this).data('id'); // Get the news ID

        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Confirm Deletion ?',
            text: '',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete action with the news ID in the query string
                window.location.href = '<?php echo $settings['oldadminname']; ?>/announcements?delete=' + newsId;
            }
        });
    });
</script>

</body>
</html>

<?php include 'footer.php'; ?>