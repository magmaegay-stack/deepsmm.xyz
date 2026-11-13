<?php include("new-header.php"); ?>

<style>
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap");

/* General Styles */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    font-family: 'Inter', sans-serif;
    background-color: #f8f9fa; /* Light background */
    color: #212529; /* Dark text color */
}

.container-fluid {
    padding: 30px 15px;
}

/* Button Styles */
.btn-primary {
    background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

.btn-danger {
    background: linear-gradient(145deg, #dc3545, #c82333);
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-danger:hover {
    background: linear-gradient(145deg, #c82333, #bd2130);
    transform: translateY(-2px);
}

/* Table Container */
.table-container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    overflow-x: auto;
}

/* Table Styles */
table.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.table thead th {
    background-color: #e9ecef;
    color: #495057;
    text-align: left;
    padding: 14px 12px;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.table tbody tr:hover {
    background-color: #f1f3f5;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f8f9fa;
}

.table td, .table th {
    color: #212529;
    padding: 14px 12px;
    font-family: 'Inter', sans-serif;
    border-bottom: 1px solid #dee2e6;
}

/* Loading Spinner */
.spinner {
    animation: rotate 1s linear infinite;
    width: 50px;
    height: 50px;
    stroke: #495057;
}

.spinner .path {
    stroke: #495057;
    stroke-linecap: round;
    animation: dash 1.5s ease-in-out infinite;
}

/* Keyframes */
@keyframes rotate {
    100% {
        transform: rotate(360deg);
    }
}

@keyframes dash {
    0% {
        stroke-dasharray: 1, 150;
        stroke-dashoffset: 0;
    }

    50% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -35;
    }

    100% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -124;
    }
}
/* Control */
#staticBackdropModal .modal-dialog .modal-content .modal-body form .mb-3 .ts-wrapper .ts-control{
  background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Special price for service */
#special_price_for_service{
background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Span Tag */
.form-group .input-group span{
  background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
    border-top-left-radius:0px !important;
    border-bottom-left-radius:0px !important;
}
/* Special price for service */
#special_price_for_service{
 border-top-left-radius:0px !important;
 border-bottom-left-radius:0px !important;
}

/* Span Tag */
.modal-dialog .modal-content .modal-body form #special_pricing_service_info .form-group .input-group span{
 border-top-left-radius:8px !important;
 border-bottom-left-radius:8px !important;
}
/* Button */
#searchButton{
 display:none;
}

/* Search input */
#searchInput{
  display: flex;
    align-items: center;
    background-color: #f1f3f5; /* Light gray background */
    border-radius: 8px;
    padding: 12px;
    color: #333333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
}
/* Th */
.table-secondary tr th{
 text-transform:uppercase;
}

/* Table Data */
.table-striped tr td{
 font-size:14px;
 transform:translatex(0px) translatey(0px);
}

/* Special pricing service name */
.table-striped tr .special_pricing_service_name{
 font-size:14px;
}

@media (max-width:992px){

 /* Th */
 .table-secondary tr th{
  font-size:14px;
 }
 
}

@media (min-width:993px){

 /* Th */
 .table-secondary tr th{
  font-size:14px;
 }
 
}
/* Flex grow 1 */
.row .flex-column .flex-grow-1{
 padding-right:0px;
 padding-left:0px;
 padding-top:0px;
 padding-bottom:0px;
}


</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex flex-column">
            <div class="d-flex flex-wrap justify-content-between mb-3">
                <button class="btn btn-labeled btn-primary" type="button" data-bs-toggle="modal" data-form="create_special_price" data-bs-target="#staticBackdropModal">
                    Create Special Price
                </button>

                <button class="btn btn-labeled btn-danger" type="button" data-ajax="true" data-action-ajax="https://<?php echo "$url/"; echo $rentaladmin; ?>/special-pricing/delete-all">
                    Delete All
                </button>
            </div>
            <!-- Search Bar -->
   <form id="searchForm" class="mb-4">
    <div class="input-group">
        <input type="text" id="searchInput" class="form-control" placeholder="Search">
        <button type="submit" id="searchButton" class="btn btn-primary">Search</button>
    </div>
</form>
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    var searchValue = this.value.toLowerCase();
    var tableRows = document.querySelectorAll('.table tbody tr');

    tableRows.forEach(function(row) {
        var rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(searchValue) ? '' : 'none';
    });
});
</script>
            <div class="table-container flex-grow-1">
                <table class="table table-striped table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Username</th>
                            <th>Service</th>
                            <th>Cost Price</th>
                            <th>Selling Price</th>
                            <th>Special Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center">
                                <svg class="spinner" viewBox="0 0 48 48">
                                    <circle class="path" cx="24" cy="24" r="20" fill="none" stroke-width="5"></circle>
                                </svg>
                                Loading...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("new-footer.php"); ?>
