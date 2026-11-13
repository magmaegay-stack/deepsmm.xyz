<?php include 'new-header.php'; ?>

<style>
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* General Styles */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden; /* Prevent scrolling */
    font-family: 'Inter', sans-serif;
    background-color: #f8f9fa; /* Light background color */
    color: #212529; /* Dark text color */
}

.container-fluid {
    padding: 30px 15px;
}

/* Button Styles */
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
    background: linear-gradient(145deg, #0056b3, #004085); /* Darker gradient on hover */
    transform: translateY(-2px); /* Slight lift effect */
}

.btn-danger {
    background: linear-gradient(145deg, #dc3545, #c82333); /* Gradient background for a professional look */
    color: #ffffff; /* Text color */
    padding: 14px 28px; /* Padding for consistency with primary button */
    font-size: 14px; /* Font size */
    font-weight: 500; /* Font weight */
    border: none; /* Remove default border */
    border-radius: 5px; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}

.btn-danger:hover {
    background: linear-gradient(145deg, #c82333, #bd2130); /* Darker gradient on hover */
    transform: translateY(-2px); /* Slight lift effect */
}

/* Table Container */
.table-container {
    background-color: #ffffff; /* Light background for table container */
    padding: 20px;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Light shadow for container */
    margin-bottom: 30px;
    overflow-x: auto; /* Enables horizontal scrolling on small devices */
}

/* Table Styles */
table.table {
    width: 100%;
    border-collapse: separate; /* Allows for more styling flexibility */
    border-spacing: 0; /* Removes spacing between cells */
}

.table thead th {
    background-color: #e9ecef; /* Light gray for header background */
    color: #212529; /* Dark text color */
    text-align: left; /* Aligns text to the left */
    padding: 14px 12px; /* Padding for header cells */
    font-weight: 600; /* Bold font weight */
    border-bottom: 2px solid #ced4da; /* Bottom border for header cells */
}

.table tbody tr {
    transition: background-color 0.3s ease; /* Transition for hover effect */
}

.table tbody tr:hover {
    background-color: #f1f1f1; /* Slightly lighter gray for hover effect */
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f8f9fa; /* Slightly different gray for striped effect */
}

.table td,
.table th {
    color: #212529; /* Dark text color */
    text-align: left; /* Aligns text to the left */
    vertical-align: middle;
    padding: 14px 12px; /* Padding for table cells */
    font-family: 'Inter', sans-serif; /* Consistent font for all cells */
    border-bottom: 1px solid #dee2e6; /* Divider lines between rows */
}

/* Loading Spinner */
.spinner {
    animation: rotate 1s linear infinite;
    width: 50px;
    height: 50px;
    stroke: #007bff; /* Primary color for the spinner */
}

.spinner .path {
    stroke: #007bff;
    stroke-linecap: round;
    animation: dash 1.5s ease-in-out infinite;
}

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

/* Modal Styles */
.modal-content {
    font-family:'Inter';
    background-color: #ffffff; /* Light background color for modal */
    color: #212529; /* Dark text color */
    border-radius: 8px; /* Rounded corners */
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Light shadow for modal */
}

.modal-header,
.modal-footer {
    border-bottom: 1px solid #ced4da; /* Light border */
}

.modal-header .modal-title {
    font-weight: 600;
}

/* Custom Modal Footer */
.custom-modal-footer .modal-footer .btn-secondary {
    background-color: #e9ecef; /* Light gray */
    color: #212529; /* Dark text color */
}

.custom-modal-footer .modal-footer .btn-primary {
    background-color: #007bff; /* Primary color */
    color: #ffffff; /* White text color */
}
/* Th */
.table-striped tr th{
 text-align:center !important;
}

/* Table Data */
.table-striped tr td{
 text-align:center;
 
}


@media (max-width: 768px) {
    .table th,
    .table td {
        padding: 12px; /* Reduced padding on smaller screens */
        font-size: 14px; /* Slightly smaller font size */
    }
}
.form-control{

    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
.form-select{

    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Span Tag */
.table-striped tr span{

 background-color:#4caf50 !important;
}
.col .table-striped{
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}
/* Th */
.table-striped tr th{
 text-transform:uppercase;
 line-height:1.42em;
}

/* Table Data */
.table-striped tr td{
 line-height:1.42em;
 background-color:#ffffff;
}

@media (min-width:769px){

 /* Table Data */
 .table-striped tr td{
  font-size:14px;
 }
 
}

@media (min-width:993px){

 /* Th */
 .table-striped tr th{
  font-size:14px;
 }
 
}
/* Th */
.table-striped tr th:nth-child(1){
 border-top-left-radius:8px;
}

/* Th */
.table-striped tr th:nth-child(8){
 border-top-right-radius:8px;
}

/* Th */
.table-striped tr th{
 transform:translatex(0px) translatey(0px);
}
/* Button */
#searchButton{
 display:none;
}

/* Search input */
#searchInput{
 border-top-right-radius:8px;
 border-bottom-right-radius:8px;
}
/* Table container */
.row .table-container{
 padding:0px;

}

/* Heading */
.col h4{
 padding-left:20px;
 padding-right:20px;
}

/* Heading */
.container-fluid h4{
 text-align:center;
}





</style>

<div class="container-fluid">
    <h4 class="mb-4" style="color: #212529;">Payment Records</h4>

   
    <!-- Search Bar -->
   <form id="searchForm" class="mb-4">
    <div class="input-group">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by Username or Order ID">
        <button type="submit" id="searchButton" class="btn btn-primary">Search</button>
    </div>
</form>
<hr>
 <form class="mb-4">
        <button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-form="add_remove_balance"
            data-bs-target="#staticBackdropModal">Add / Deduct Balance</button>
    </form>
    <!-- Responsive Table Container with Integrated Button -->
    <div class="row">
        <div class="col">
            <div class="table-container">
                
                <!-- Add / Deduct Balance Button Integrated in Form -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Method</th>
                            <th>User Balance</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date & Time</th>
                            <th>Order ID</th>
                        </tr>
                    </thead>
                    <tbody id="paymentRecordTableBody">
                        <tr>
                            <td colspan="8">
                                <center>
                                    <svg class="spinner" viewBox="0 0 48 48">
                                        <circle class="path" cx="24" cy="24" r="20" fill="none" stroke-width="4"></circle>
                                    </svg>
                                    Loading...
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdropModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add / Deduct Balance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal body content here -->
                <tr>
                    <td colspan="8">
                        <center>
                            <svg class="spinner" viewBox="0 0 48 48">
                                <circle class="path" cx="24" cy="24" r="20" fill="none" stroke-width="4"></circle>
                            </svg>
                            Loading...
                        </center>
                    </td>
                </tr>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');

    searchInput.addEventListener('input', function() {
        const searchQuery = searchInput.value;
        searchButton.disabled = true;
        searchButton.textContent = 'Searching';
        loadPaymentRecords(searchQuery, function() {
            searchButton.disabled = false;
            searchButton.textContent = 'Search';
        });
    });
});

function loadPaymentRecords(searchQuery = '', callback) {
    fetch('<?= site_url("$rentaladmin/fund-add-history?action=getData&search=") ?>' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('paymentRecordTableBody');
            tbody.innerHTML = '';
            if (data.length > 0) {
                data.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.username}</td>
                        <td>${item.method}</td>
                        <td>${item.user_balance}</td>
                        <td>${item.amount}</td>
                        <td>${item.status}</td>
                        <td>${item.created_at}</td>
                        <td>${item.extra}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8">
                            <center>No records found</center>
                        </td>
                    </tr>
                `;
            }
            if (callback) callback();
        })
        .catch(error => {
            console.error('Error:', error);
            if (callback) callback();
        });
}
</script>
<?php include 'new-footer.php'; ?>