<?php include 'new-header.php'; ?>

<style>
/* General Styles */
html, body {
    width:100%;
    font-family: 'Inter', sans-serif;
    background-color: #f8f9fa;
    color: #212529;
    overflow-x:hidden !important;
}



.card {
    background-color: #ffffff;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
    color: #ffffff;
    font-weight: 600;
    font-size: 18px;
    padding: 15px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-body {
    padding: 20px;
}

.form-label {
    font-weight: 500;
    color: #495057;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
}

.input-group-text {
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 0 5px 5px 0;
}

/* Button Styles */
.btn-primary {
    background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
    color: #ffffff; /* Text color */
    padding: 14px 28px; /* Padding for a more prominent button */
    font-size: 16px; /* Font size */
    font-weight: 500; /* Font weight */
    border: none; /* Remove default border */
    border-radius: 5px; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
    transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
  }


.btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #004494); /* Darker gradient on hover */
   transform: translateY(-2px); /* Slight lift effect */

}

/* Select Dropdown */
select.form-control {
    background-color: #ffffff;
    color: #495057;
}

/* Card Footer */
.card-footer {
    background-color: #f1f3f5;
    border-top: 1px solid #e9ecef;
    padding: 15px;
    text-align: right;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header {
        font-size: 16px;
        text-align: center;
    }

    .btn-primary {
        width: 100%;
    }
}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-12 offset-md-3 increase-decrease-form">
            <div class="card">
                <div class="card-header">Update Prices</div>
                <form action="https://<?php echo "$url/"; echo $rentaladmin; ?>/update-prices" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="special_pricing_service_type" class="form-label">Services Type</label>
                                <select name="service_type" id="special_pricing_service_type" class="form-control">
                                    <option value="all_services">All Services</option>
                                    <option value="seller_services">Provider Services</option>
                                    <option value="manual_services">Manual Services</option>
                                </select>
                            </div>
                        </div>

                        <div style="display:none;" id="special-pricing-seller-select-div" class="form-group">
                            <div class="mb-3">
                                <label for="select-seller" class="form-label">Providers</label>
                                <select class="form-control fsb-ignore multiple" name="sellers[]" id="select-seller" multiple autocomplete="off" data-placeholder="Select a provider">
                                    <?=$providers_option;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Profit Percentage</label>
                            <div class="input-group mb-3">
                                <input type="number" name="profit-percent-value" id="profit-percent-value" class="form-control" placeholder="10" aria-label="Profit Percentage">
                                <span class="input-group-text"><i class="bi bi-percent"></i></span>
                            </div>
                        </div>

                        <div class="form-group" id="action_type_div">
                            <!-- Placeholder for any additional actions -->
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" data-loading-text="Saving..." class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'new-footer.php'; ?>
