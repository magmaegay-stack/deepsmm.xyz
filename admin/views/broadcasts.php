<?php include 'header.php'; ?>


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
    $conn->query("DELETE FROM broadcast_notifications WHERE id=$id");
    $alertMessage = "<div class='alert alert-success'>Broadcast deleted successfully.</div>";
}

// Fetch Broadcasts for History Card
$result = $conn->query("SELECT * FROM broadcast_notifications ORDER BY id DESC");

// Handle Form Submission (Add or Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'];
    $type = $_POST['type'];
    $info = $_POST['info'];
    $description = $_POST['description'];
    $target_users = $_POST['target_users'];
    $expiry_date = $_POST['expiry_date'];
    $status = $_POST['status'];
    $close_button_text = $_POST['close_button_text'];
    $close_button_color = $_POST['close_button_color'];
    $show_on_paths = isset($_POST['show_on_paths']) ? implode(',', $_POST['show_on_paths']) : ''; // Join paths into a comma-separated string
    $broadcast_page = $_POST['broadcast_page'] ?? '';

    if ($id) {
        // Update Broadcast
        $stmt = $conn->prepare("UPDATE broadcast_notifications SET title=?, type=?, info=?, description=?, target_users=?, expiry_date=?, status=?, close_button_text=?, close_button_color=?, broadcast_page=?, show_on_paths=? WHERE id=?");
        $stmt->bind_param("sssssssssssi", $title, $type, $info, $description, $target_users, $expiry_date, $status, $close_button_text, $close_button_color, $broadcast_page, $show_on_paths, $id);
        if ($stmt->execute()) {
            $alertMessage = "<div class='alert alert-success'>Broadcast updated successfully.</div>";
        } else {
            $alertMessage = "<div class='alert alert-danger'>Error updating broadcast. Please try again.</div>";
        }
    } else {
        // Insert New Broadcast
        $stmt = $conn->prepare("INSERT INTO broadcast_notifications (title, type, info, description, target_users, expiry_date, status, close_button_text, close_button_color, broadcast_page, show_on_paths) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $title, $type, $info, $description, $target_users, $expiry_date, $status, $close_button_text, $close_button_color, $broadcast_page, $show_on_paths);
        if ($stmt->execute()) {
            $alertMessage = "<div class='alert alert-success'>Broadcast added successfully.</div>";
        } else {
            $alertMessage = "<div class='alert alert-danger'>Error adding broadcast. Please try again.</div>";
        }
    }
}

// Fetch Broadcast for Editing
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editData = $conn->query("SELECT * FROM broadcast_notifications WHERE id=$id")->fetch_assoc();
}
?>
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

.form-control{

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
.btn-primary{
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
div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm{
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
div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel{
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
.order-table tr th{
 text-transform:uppercase;
 text-align:center;
}

/* Table Data */
.order-table tr td{
 text-align:center;
}

/* Button */
.order-table tr .btn-warning{
 background-image:none;
 color:#5a5a5a;
 box-shadow:0px 4px 8px 0px rgba(0,0,0,0);
}

/* Button */
.order-table tr .btn-danger{
 background-color:rgba(217,4,41,0);
 color:#c0392b;
}
/* Button */
.order-table tr .btn-warning{
 background-color:rgba(240,173,78,0);
}
.container-md .form-control .dropdown-toggle{
 background-color:rgba(255,255,255,0);
 top:5px;
 box-shadow:0px 3px 5px 0px rgba(0,0,0,0) inset;

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

<div class="container container-md">
    <ul class="log-menu">
   <li class="active">
     <a href="<?php echo site_url("$rentaladmin/broadcasts") ?>">Broadcasts</a>



   </li>
   <li>
     <a href="<?php echo site_url("$rentaladmin/announcements") ?>">Announcements</a>
   </li>
   
</ul><br>
    <div class="row">
    

        <div class="col-md-12">
            <div class="panel panel-default">
             
                <div class="panel-body">
                   
                    <h2 class="text-center"><?= isset($editData) ? "Edit Broadcast" : "Create Broadcast" ?></h2>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?= $editData['title'] ?? '' ?>" required>
                        </div>

                       <div class="form-group">
    <label class="form-group__service-name">Icon Type</label>
    <select class="form-control" name="type">
        <option value="none" <?= isset($editData) && $editData['type'] == 'none' ? 'selected' : '' ?>>None</option>
        <option value="info" <?= isset($editData) && $editData['type'] == 'info' ? 'selected' : '' ?>>Info</option>
        <option value="warning" <?= isset($editData) && $editData['type'] == 'warning' ? 'selected' : '' ?>>Warning</option>
        <option value="success" <?= isset($editData) && $editData['type'] == 'success' ? 'selected' : '' ?>>Success</option>
        <option value="error" <?= isset($editData) && $editData['type'] == 'error' ? 'selected' : '' ?>>Error</option>
    </select>
</div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea id="summernote" name="description" class="form-control"><?= $editData['description'] ?? '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-group__service-name">Status</label>
                            <select class="form-control" name="status">
                                <option value="active" <?= isset($editData) && $editData['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= isset($editData) && $editData['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control" value="<?= $editData['expiry_date'] ?? '' ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm Button Text</label>
                            <input type="text" name="close_button_text" class="form-control" value="<?= $editData['close_button_text'] ?? 'Okay!' ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm Button Color</label>
                            <input type="color" name="close_button_color" class="form-control" value="<?= $editData['close_button_color'] ?? '#2272d6' ?>">
                        </div>
                           <div class="form-group">
                            <label class="form-label">Target Users</label>
                            <select name="target_users" class="form-control">
                                <option value="all" <?= isset($editData) && $editData['target_users'] == 'all' ? 'selected' : '' ?>>All Users</option>
                                <option value="logged-in" <?= isset($editData) && $editData['target_users'] == 'logged-in' ? 'selected' : '' ?>>Logged-In Users</option>
                                <option value="not-logged-in" <?= isset($editData) && $editData['target_users'] == 'not-logged-in' ? 'selected' : '' ?>>Not Logged-In Users</option>
                            </select>
                        </div>
<div class="form-group">
    <label class="form-label">Select Paths:</label>

    <?php 
    $selectedPaths = !empty($editData['show_on_paths']) ? explode(',', $editData['show_on_paths']) : [];
    $predefinedPaths = ['/', '/orders', '/signup', '/addfunds','/services','/tickets','/api','/account'];

    // Extract only the custom paths (not in predefined list)
    $customPaths = array_diff($selectedPaths, $predefinedPaths);
    ?>

    <!-- Dropdown for Predefined Paths -->
    <select name="show_on_paths[]" id="predefinedPaths" class="form-control selectpicker" multiple data-live-search="true">
        <?php foreach ($predefinedPaths as $path): ?>
            <option value="<?= htmlspecialchars($path) ?>" <?= in_array($path, $selectedPaths) ? 'selected' : '' ?>>
                <?= htmlspecialchars($path) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<!-- Text Input for Custom Paths -->
<div class="form-group">
    <label for="customPaths">Add Custom Paths:</label>
    <div class="input-group">
        <input type="text" id="customPaths" class="form-control" placeholder="Enter custom path" value="<?= htmlspecialchars(implode(',', $customPaths)) ?>">
        <button type="button" class="btn add-custom-path-button" id="addCustomPath">Add</button>
    </div>
</div>

<style>
/* CSS for input group and button */
.input-group {
    display: flex;
}

.add-custom-path-button {
    background-color:#449ee3;
    color: #ffffff;
    font-weight: bold;
    padding: 8px 18px;
    border: none;
    border-radius: 3px;
    font-size: 12px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    white-space: nowrap; /* Prevent button text from wrapping */
    /* Remove any margin */
}


</style>


                        <button type="submit" class="btn btn-primary w-100"><?= isset($editData) ? "Update Broadcast" : "Create Broadcast" ?></button>
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
                                    <th>Icon Type</th>
                                    <th>Status</th>
                                    <th>Expiry Date</th>
                                    <th>Close Button</th>
                                    <th>Show on Paths</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        
                                        <td><?= htmlspecialchars($row['title']) ?></td>
                                        <td><?= ucfirst($row['type']) ?></td>
                                        <td><?= ucfirst($row['status']) ?></td>
                                        <td><?= $row['expiry_date'] ?></td>
                                        <td><?= $row['close_button_text'] ?></td>
                                        <td><?= empty($row['show_on_paths']) ? 'All' : htmlspecialchars($row['show_on_paths']) ?></td>
                                        <td>
                                            <a href="<?php echo $settings['oldadminname']; ?>/broadcasts?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
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
<script>
document.getElementById('addCustomPath').addEventListener('click', function () {
    var customPathInput = document.getElementById('customPaths');
    var customPathValue = customPathInput.value.trim();

    if (customPathValue !== '') {
        var newOption = new Option(customPathValue, customPathValue, true, true);
        document.getElementById('predefinedPaths').appendChild(newOption);
        $('.selectpicker').selectpicker('refresh'); // Refresh Bootstrap Select
        customPathInput.value = ''; // Clear input field
    }
});


</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({ height: 300 });

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
        const broadcastId = $(this).data('id'); // Get the broadcast ID

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
                // Redirect to the delete action with the broadcast ID in the query string
                window.location.href = '<?php echo $settings['oldadminname']; ?>/broadcasts?delete=' + broadcastId;
            }
        });
    });
</script>

</body>
</html>




<?php

include 'footer.php'; ?>