<?php include 'header.php'; ?>

<style>


/* Font import */
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

/* Base styles */
body {
    font-family: 'Inter', sans-serif;
    background-color: #f0f4f8 !important;
    color: #2c3e50;
}

.container {
    
    max-width: 1440px;
}

/* Navigation tabs */
.log-menu {
    display: flex;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    padding: 6px;
    margin-bottom: 24px;
    list-style: none;
    position: relative;
    overflow: hidden;
}

.log-menu li {
    flex: 1;
    list-style: none;
    text-align: center;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.log-menu li a {
    display: block;
    padding: 14px 24px;
    color: #5d6d7e;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
    transition: all 0.3s ease;
    border-radius: 8px;
}

.log-menu li.active a {
    color: #2c3e50;
    font-weight: 600;
}

.log-menu li.active {
    background-color: #e0e6ee;
    border-radius: 8px;
}

.log-menu li:hover:not(.active) a {
    color: #2c3e50;
    background-color: rgba(224, 230, 238, 0.5);
    border-radius: 8px;
}

/* Dashboard grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

/* Stat cards */
.stat-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.stat-card-header {
    padding: 20px 20px 0 20px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

.stat-card-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(145deg, #e0e6ee, #ffffff);
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.stat-card-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.stat-card-value {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
}

.stat-card-label {
    font-size: 14px;
    color: #5d6d7e;
    font-weight: 500;
}

.stat-card-footer {
    padding: 15px 20px;
    border-top: 1px solid #f0f4f8;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(145deg, #f7f9fc, #ffffff);
    transition: all 0.3s ease;
}

.stat-card-footer a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    color: #5d6d7e;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s ease;
}

.stat-card-footer:hover {
    background: linear-gradient(145deg, #e0e6ee, #f7f9fc);
}

.stat-card-footer a:hover {
    color: #2c3e50;
}

.stat-card-footer a i {
    transition: transform 0.3s ease;
}

.stat-card-footer a:hover i {
    transform: translateX(4px);
}

/* Analytics section */
.analytics-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 30px;
}

.analytics-header {
    padding: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #f0f4f8;
}

.analytics-title {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.analytics-controls {
    display: flex;
    align-items: center;
    gap: 12px;
}

.analytics-btn {
    background-color: #f7f9fc;
    border: 1px solid #e0e6ee;
    color: #5d6d7e;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.analytics-btn:hover {
    background-color: #e0e6ee;
    color: #2c3e50;
}

.analytics-btn.active {
    background-color: #2c3e50;
    color: #ffffff;
    border-color: #2c3e50;
}

.side-menu-btn {
    background-color: #f7f9fc;
    border: 1px solid #e0e6ee;
    color: #5d6d7e;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.side-menu-btn:hover {
    background-color: #e0e6ee;
    color: #2c3e50;
}

.sidebar-menu-content {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #ffffff;
    border: 1px solid #e0e6ee;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    min-width: 160px;
    margin-top: 8px;
    overflow: hidden;
}

.sidebar-menu-content button {
    width: 100%;
    padding: 12px 16px;
    background: none;
    border: none;
    text-align: left;
    color: #5d6d7e;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.sidebar-menu-content button:hover {
    background-color: #f7f9fc;
    color: #2c3e50;
}

.sidebar-menu-content button.active {
    background-color: #2c3e50;
    color: #ffffff;
}

.analytics-content {
    padding: 8px;
}

.chart-container {
    position: relative;
    height: 400px;
    width: 100%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    
    .dashboard-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
    }
    
    .stat-card-value {
        font-size: 24px;
    }
    
    .analytics-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .analytics-controls {
        width: 100%;
        justify-content: space-between;
    }
    
    .chart-container {
        height: 300px;
    }
}

@media (max-width: 576px) {
    .log-menu {
        flex-direction: column;
        gap: 8px;
    }
    
    .log-menu li {
        width: 100%;
    }
    
    .stat-card-header {
        flex-direction: column;
        gap: 16px;
    }
    
    .stat-card-icon {
        margin-bottom: 8px;
    }
    
    .chart-container {
        height: 250px;
    }
}

/* Modal styling */
.modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.modal-header {
    background-color: #2c3e50;
    color: #ffffff;
    padding: 20px 24px;
    border-bottom: none;
}

.modal-body {
    padding: 24px;
}

.btn-primary {
    background-color: #2c3e50;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #1a2530;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
}

.btn-default {
    background-color: #f7f9fc;
    border: 1px solid #e0e6ee;
    color: #5d6d7e;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-default:hover {
    background-color: #e0e6ee;
    color: #2c3e50;
}

/* Legacy overrides */
.panel {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    margin-bottom: 0 !important;
}

.panel-heading {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
}

.panel-body {
    padding: 0 !important;
}

.panel-footer {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
}

.col-lg-3, .col-md-6 {
    padding: 0 !important;
}

.col-lg-12, .col-md-12 {
    padding: 0 !important;
}

</style>

<script src="https://cdn.lordicon.com/fudrjiwc.js"></script>

<div class="container">
    <ul class="log-menu">
        <li class="active" data-target="summarySection">
            <a href="javascript:void(0)">Summary</a>
        </li>
        <li data-target="analyticsSection">
            <a href="javascript:void(0)">Analytics</a>
        </li>
    </ul>

    <div id="summarySection">
        <div class="dashboard-grid">
            <!-- Total Users -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/dqxvvqzi.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"clients"]);?></div>
                    <div class="stat-card-label">Total Users</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/clients">
                        <span>See In Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/cllunfud.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"orders"]) ?></div>
                    <div class="stat-card-label">Total Orders</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/orders">
                        <span>See In Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Refilling Orders -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/fsihxwoq.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"tasks"]) ?></div>
                    <div class="stat-card-label">Refilling Orders</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/tasks">
                        <span>See In Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Unread Tickets -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/kjkiqtxg.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"tickets","where"=>["client_new"=>2]]) ?></div>
                    <div class="stat-card-label">Unread Tickets</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/tickets">
                        <span>See In Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Received Payments -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/pimvysaa.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"payments","where"=>["payment_status"=>3]]) ?></div>
                    <div class="stat-card-label">Received Payments</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/fund-add-history">
                        <span>See in Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- Active Broadcasts -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/guqkthkk.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"notifications_popup","where"=>["status"=>1]]) ?></div>
                    <div class="stat-card-label">Active Broadcasts</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/broadcasts">
                        <span>See In Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
 <!-- Total Providers -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/jldyvygy.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"service_api"]) ?></div>
                    <div class="stat-card-label">Total Providers</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/settings/providers">
                        <span>See In Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- Total Categories -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/mfzonmkf.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"categories","where"=>["category_deleted"=>0]]) ?></div>
                    <div class="stat-card-label">Total Categories</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/services">
                        <span>See in Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Services -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <lord-icon
                            src="https://cdn.lordicon.com/ozqvdvoh.json"
                            trigger="loop"
                            delay="2000"
                            style="width:40px;height:40px">
                        </lord-icon>
                    </div>
                </div>
                <div class="stat-card-content">
                    <div class="stat-card-value"><?php echo countRow(["table"=>"services","where"=>["service_deleted"=>0]]) ?></div>
                    <div class="stat-card-label">Total Services</div>
                </div>
                <div class="stat-card-footer">
                    <a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/services">
                        <span>See In Detail</span>
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

           
          

           

           

            
        </div>
    </div>

    <div id="analyticsSection" style="display: none;">
        <div class="analytics-card">
            <div class="analytics-header">
                <h3 class="analytics-title" id="chartTitle">Daily Statistics</h3>
                <div class="analytics-controls">
                    <button id="downloadChartBtn" class="analytics-btn">
                        <i class="fa fa-download"></i>
                        Export
                    </button>
                    <div style="position: relative;">
                        <button class="side-menu-btn" id="sideMenuBtn">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="sidebar-menu-content" id="sideMenuContent">
                            <button id="dailyBtn" class="active">Daily</button>
                            <button id="monthlyBtn">Monthly</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="analytics-content">
                <div class="chart-container">
                    <canvas id="stackedAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>Are you sure you want to proceed?</h4>
                <div align="center" style="margin-top: 20px;">
                    <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div id="modalContent"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart.js configuration
const ctx = document.getElementById('stackedAreaChart').getContext('2d');

// Create gradients that match the design
const gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
gradientBlue.addColorStop(0, 'rgba(44, 62, 80, 0.6)');
gradientBlue.addColorStop(1, 'rgba(44, 62, 80, 0.1)');

const gradientGreen = ctx.createLinearGradient(0, 0, 0, 400);
gradientGreen.addColorStop(0, 'rgba(46, 204, 113, 0.6)');
gradientGreen.addColorStop(1, 'rgba(46, 204, 113, 0.1)');

const gradientYellow = ctx.createLinearGradient(0, 0, 0, 400);
gradientYellow.addColorStop(0, 'rgba(241, 196, 15, 0.6)');
gradientYellow.addColorStop(1, 'rgba(241, 196, 15, 0.1)');

const gradientRed = ctx.createLinearGradient(0, 0, 0, 400);
gradientRed.addColorStop(0, 'rgba(231, 76, 60, 0.6)');
gradientRed.addColorStop(1, 'rgba(231, 76, 60, 0.1)');

const dailyLabels = Array.from({length: <?php echo count($dailyData); ?>}, (_, i) => i + 1);
const monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

const dailyData = {
    labels: dailyLabels,
    datasets: [
        {
            label: 'Users',
            data: <?php echo json_encode(array_values($dailyData)); ?>,
            backgroundColor: gradientBlue,
            borderColor: 'rgba(0, 123, 255, 1)',
            pointBackgroundColor: 'rgba(0, 123, 255, 1)',
            fill: true,
            tension: 0.4
        },
        {
            label: 'Orders',
            data: <?php echo json_encode(array_values($dailyOrdersData)); ?>,
            backgroundColor: gradientGreen,
            borderColor: 'rgba(0, 227, 150, 1)',
            pointBackgroundColor: 'rgba(0, 227, 150, 1)',
            fill: true,
            tension: 0.4
        },
        {
            label: 'Payments',
            data: <?php echo json_encode(array_values($dailyPaymentsData)); ?>,
            backgroundColor: gradientYellow,
            borderColor: 'rgba(255, 193, 7, 1)',
            pointBackgroundColor: 'rgba(255, 193, 7, 1)',
            fill: true,
            tension: 0.4
        },
        {
            label: 'Profits',
            data: <?php echo json_encode(array_values($dailyProfitsData)); ?>,
            backgroundColor: gradientRed,
            borderColor: 'rgba(255, 99, 132, 1)',
            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
            fill: true,
            tension: 0.4
        }
    ]
};

const monthlyData = {
    labels: monthlyLabels,
    datasets: [
        {
            label: 'Users',
            data: <?php echo json_encode(array_values($monthlyData)); ?>,
            backgroundColor: gradientBlue,
            borderColor: 'rgba(0, 123, 255, 1)',
            pointBackgroundColor: 'rgba(0, 123, 255, 1)',
            fill: true,
            tension: 0.4
        },
        {
            label: 'Orders',
            data: <?php echo json_encode(array_values($monthlyOrdersData)); ?>,
            backgroundColor: gradientGreen,
            borderColor: 'rgba(0, 227, 150, 1)',
            pointBackgroundColor: 'rgba(0, 227, 150, 1)',
            fill: true,
            tension: 0.4
        },
        {
            label: 'Payments',
            data: <?php echo json_encode(array_values($monthlyPaymentsData)); ?>,
            backgroundColor: gradientYellow,
            borderColor: 'rgba(255, 193, 7, 1)',
            pointBackgroundColor: 'rgba(255, 193, 7, 1)',
            fill: true,
            tension: 0.4
        },
        {
            label: 'Profits',
            data: <?php echo json_encode(array_values($monthlyProfitsData)); ?>,
            backgroundColor: gradientRed,
            borderColor: 'rgba(255, 99, 132, 1)',
            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
            fill: true,
            tension: 0.4
        }
    ]
};

const config = {
    type: 'line',
    data: dailyData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    padding: 20,
                    font: {
                        family: 'Inter',
                        size: 12,
                        weight: '500'
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(255, 255, 255, 0.9)',
                titleColor: '#2c3e50',
                bodyColor: '#5d6d7e',
                borderColor: '#e0e6ee',
                borderWidth: 1,
                padding: 12,
                boxPadding: 6,
                usePointStyle: true,
                bodyFont: {
                    family: 'Inter'
                },
                titleFont: {
                    family: 'Inter',
                    weight: '600'
                }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: {
                        family: 'Inter',
                        size: 11
                    },
                    color: '#5d6d7e'
                }
            },
            y: {
                grid: {
                    display: true,
                    color: 'rgba(224, 230, 238, 0.5)'
                },
                ticks: {
                    font: {
                        family: 'Inter',
                        size: 11
                    },
                    color: '#5d6d7e'
                }
            }
        },
        elements: {
            point: {
                radius: 3,
                hoverRadius: 5
            },
            line: {
                borderWidth: 2
            }
        },
        interaction: {
            mode: 'index',
            intersect: false
        }
    }
};

const stackedAreaChart = new Chart(ctx, config);

// Event listeners
document.getElementById('sideMenuBtn').addEventListener('click', () => {
    const sideMenuContent = document.getElementById('sideMenuContent');
    sideMenuContent.style.display = sideMenuContent.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', (event) => {
    const sideMenuContent = document.getElementById('sideMenuContent');
    const sideMenuBtn = document.getElementById('sideMenuBtn');
    if (!sideMenuContent.contains(event.target) && !sideMenuBtn.contains(event.target)) {
        sideMenuContent.style.display = 'none';
    }
});

document.getElementById('dailyBtn').addEventListener('click', () => {
    document.getElementById('chartTitle').innerText = 'Daily Statistics';
    document.getElementById('dailyBtn').classList.add('active');
    document.getElementById('monthlyBtn').classList.remove('active');
    stackedAreaChart.data = dailyData;
    stackedAreaChart.update();
});

document.getElementById('monthlyBtn').addEventListener('click', () => {
    document.getElementById('chartTitle').innerText = 'Monthly Statistics';
    document.getElementById('monthlyBtn').classList.add('active');
    document.getElementById('dailyBtn').classList.remove('active');
    stackedAreaChart.data = monthlyData;
    stackedAreaChart.update();
});

document.getElementById('downloadChartBtn').addEventListener('click', () => {
    const link = document.createElement('a');
    link.href = stackedAreaChart.toBase64Image();
    link.download = 'report.png';
    link.click();
});

// Navigation functionality
document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".log-menu li");
    const sections = {
        summarySection: document.getElementById("summarySection"),
        analyticsSection: document.getElementById("analyticsSection")
    };

    // Initially show only summarySection
    sections.analyticsSection.style.display = "none";

    menuItems.forEach(item => {
        item.addEventListener("click", function () {
            // Remove active class from all
            menuItems.forEach(i => i.classList.remove("active"));
            this.classList.add("active");

            // Get target section
            const targetId = this.getAttribute("data-target");

            // Hide all sections
            for (let key in sections) {
                sections[key].style.display = "none";
            }

            // Show the target section
            if (sections[targetId]) {
                sections[targetId].style.display = "block";
            }
        });
    });
});
</script>

<?php include 'footer.php'; ?>