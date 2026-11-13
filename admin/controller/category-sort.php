<?php
if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

if ($admin["access"]["update-prices"] != 1) {
    header("Location:" . site_url("$rentaladmin"));
    exit();
}

// Fetch categories
$categories = $conn->prepare("SELECT * FROM categories ORDER BY category_line ASC");
$categories->execute();
$categories = $categories->fetchAll(PDO::FETCH_ASSOC);

$list = "";
foreach ($categories as $category) {
    $list .= '
        <li data-category-id="' . $category["category_id"] . '" class="list-group-item">
            <span class="category-sort-handle">⋮⋮</span>
            <input type="text" class="category-edit-input" 
                value="' . htmlspecialchars($category["category_name"]) . '" 
                data-category-id="' . $category["category_id"] . '">
        </li>';
}

// Handle sorting and updating
if ($_POST) {
    $action = $_POST["action"];
    // Update category name
    if ($action == "update_category") {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $update_name = $conn->prepare("UPDATE categories SET category_name=:category_name WHERE category_id=:category_id");
        $update_name->execute([
            'category_name' => $category_name,
            'category_id' => $category_id
        ]);
        echo json_encode(["status" => "success", "message" => "Category updated successfully."]);
        exit();
    }
}

if($_POST){
$action = $_POST["action"];
if($action == "sort_category"){
$category_list_array = json_decode(base64_decode($_POST["category_list"]), true);
array_unshift($category_list_array,"");
unset($category_list_array[0]);
foreach($category_list_array as $index => $category_id){
  $update_position = $conn->prepare("UPDATE categories SET category_line=:category_line WHERE category_id=:category_id");
  $update_position->execute(array(
   "category_line" => $index,
   "category_id" => $category_id
  ));
}
exit();
}
}

require admin_view("category-sort");
