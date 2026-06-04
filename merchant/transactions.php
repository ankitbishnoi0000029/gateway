<?php include "header.php"; ?>
<?php
if($userdata["aadhar_kyc"] == 1){
    echo "<script> location.replace('dashboard?aadhar_kyc=0') </script>";
}  
 ?>

<div id="emoji-widget">
    <img src="https://cdnl.iconscout.com/lottie/premium/thumb/customer-care-8147491-6529814.gif" alt="GIF Widget">
</div>

<audio id="widget-audio" src="https://meraqr.in/Voice/transaction.mp3"></audio>

<script>
    document.getElementById('emoji-widget').onclick = () => document.getElementById('widget-audio').play();
</script>

<style>
/* Modal box */
.modal-box {
    width: 100%;
    max-width: 600px;
    padding: 20px;
    font-size: 14px;
}

/* Media query for mobile */
@media (max-width: 768px) {
    .modal-box {
        margin-left: 10px;
        margin-right: 10px;
    }
}

/* Header */
.modal-header1 {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.modal-subheader {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

/* Details section */
.modal-details {
    background: #eeeeee;
    border: 1px solid #e1e5ec;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 20px;
}

p.value {
    font-size: 18px !important;
    font-weight: 600 !important;
    letter-spacing: 0.4px;
}

p#successtxn {
    color: #42db4a;
}

p#failedtxn {
    color: #eb5353;
}

.modal-details p {
    margin: 0px 0;
    font-size: 15px;
    line-height: 24px;
    font-weight: 500;
    color: #333;
}

.modal-details h6 {
    font-size: 17px;
    margin: 0px;
    margin-bottom: 10px;
}

.modal-details p strong {
    font-weight: bold;
    font-size: 16px;

}

/* Grid layout for details */
.modal-details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4px;
}

.modal-details-grid .label {
    font-weight: 500;
    font-size: 16px;
    line-height: 22px;
}

.modal-details .total {
    font-size: 16px;
    font-weight: bold;
    color: #4CAF50;
    margin-top: 0px;
}

/* Buttons */
.modal-buttons {
    display: flex;
    justify-content: center;
}

.modal-buttons button {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 10px;
    transition: background 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.modal-buttons .cancel-button {
    background-color: #fff;
    color: #333;
    border: 1px solid #ccc;
    margin-right: 10px;
}

.modal-buttons .cancel-button:hover {
    background-color: #f2f2f2;
}

.modal-buttons .confirm-button {
    background-color: #25a6a1;
    color: white;
}

.modal-buttons .confirm-button:hover {
    background-color: #0994BB;
}
</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-pie-chart"></i> Transactions</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
        </ul>
    </div>
    </div>
    <div class="tile mb-4">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row row-card-no-pd">
                        <div class="col-md-12">
                            <div class="main-panel">
                                <div class="content">
                                    <div class="container-fluid">
                                        <div class="row row-card-no-pd">
                                            <div class="col-md-12">
                                                <form method="POST" action="<?= $_SERVER["PHP_SELF"]; ?>" class="row mb-4">
                                                    <div class="col-md-3 mb-2">
                                                        <label>From Date</label>
                                                        <input type="text" name="from_date" id="fdate" value="<?= date("Y-m-d") ?>" placeholder="DD-MM-YYYY" class="form-control datepicker" readonly>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <label>To Date</label>
                                                        <input type="text" name="to_date" id="edate" value="<?= date("Y-m-d") ?>" placeholder="DD-MM-YYYY" class="form-control datepicker" readonly>
                                                    </div>

                                                    <div class="col-md-2 mb-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" id="viewtxndetailsBtn" class="btn btn-primary btn-block">View Details</button>
                                                    </div>
                                                    <div class="col-md-2 mb-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" name="search" class="btn btn-primary btn-block">Search</button>
                                                    </div>

                                                </form>

                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Customer Mobile</th>
                                                                <th>TransactionId</th>
                                                                <th>Date Time</th>
                                                                <th>Payee App</th>
                                                                <th>Payee VPA</th>
                                                                <th>Gateway Txn</th>
                                                                <th>Bank RRN</th>
                                                                <th>Order ID</th>
                                                                <th>Remark</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php

                                                            if ($userdata['role'] == 'User' || $userdata['role'] == 'Admin') {
                                                                $token = $userdata['user_token'];

                                                                if (isset($_POST["search"])) {

                                                                    $from_date = $_POST["from_date"];
                                                                    $to_date = $_POST["to_date"];

                                                                    $query = "SELECT `id`, `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status`, `remark1` FROM `orders` WHERE user_token = '$token' AND (DATE(create_date) BETWEEN '$from_date' AND '$to_date') AND user_mode = '1' ORDER BY `id` DESC";
                                                                } else {

                                                                    $from_date = date("Y-m-d");
                                                                    $to_date = date("Y-m-d");

                                                                    $query = "SELECT `id`, `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status`, `remark1` FROM `orders` WHERE user_token = '$token' AND (DATE(create_date) BETWEEN '$from_date' AND '$to_date') AND user_mode = '1' ORDER BY `id` DESC";
                                                                }

                                                                $query_run = mysqli_query($conn, $query);
                                                                $i = 1;

                                                                if ($query_run) {
                                                                    while ($row = mysqli_fetch_assoc($query_run)) {

                                                                        $fetchreport = $conn->query("SELECT vpa,paymentApp FROM `reports` WHERE  order_id = '{$row["order_id"]}'")->fetch_assoc();

                                                                        echo "<tr>";
                                                                        echo "<td>" . htmlspecialchars($i++, ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['customer_mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['byteTransactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['create_date'], ENT_QUOTES, 'UTF-8') . "</td>";

                                                                        echo "<td>" . htmlspecialchars($fetchreport['paymentApp'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($fetchreport['vpa'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['gateway_txn'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['utr'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['remark1'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

                                                                        if ($row['status'] == "SUCCESS") {
                                                                            $sts = 'Success';
                                                                            $cls = "badge badge-success";
                                                                        } else if ($row['status'] == "FAILURE") {
                                                                            $sts = 'Failed';
                                                                            $cls = "badge badge-danger";
                                                                        } else {
                                                                            $sts = 'Scanning';
                                                                            $cls = "badge badge-warning";
                                                                        }
                                                                        echo "<td style='width=80px;display:flex;'>
                                                                        <button class='$cls'>" . $sts . "</button>";
                                                                        if ($sts == 'Scanning') {
                                                                            echo '<button class="btn btn-sm btn-success ml-2 updatetxnstbtn" data-txnid="' . $row['order_id'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                                                        }
                                                                        echo "</td>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                            } else {
                                                                $token = $userdata['user_token'];

                                                                if (isset($_POST["search"])) {

                                                                    $from_date = $_POST["from_date"];
                                                                    $to_date = $_POST["to_date"];

                                                                    $query = "SELECT `id`, `transactionId`, `date`, `vpa`,`paymentApp`,`mobile`, `UTR`, `description`, `order_id`, `amount`, `status`,`remark1` FROM `reports` WHERE (DATE(date) BETWEEN '$from_date' AND '$to_date') AND user_mode = '1' ORDER BY id DESC LIMIT 1000";
                                                                } else {

                                                                    $from_date = date("Y-m-d");
                                                                    $to_date = date("Y-m-d");

                                                                    $query = "SELECT `id`, `transactionId`, `date`, `vpa`,`paymentApp`,`mobile`, `UTR`, `description`, `order_id`, `amount`, `status`,`remark1` FROM `reports` WHERE (DATE(date) BETWEEN '$from_date' AND '$to_date') AND user_mode = '1' ORDER BY id DESC LIMIT 1000";
                                                                }
                                                                $query_run = mysqli_query($conn, $query);

                                                                if ($query_run) {
                                                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                                                        echo "<tr>";
                                                                        echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['paymentApp'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['vpa'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['UTR'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['remark1'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                                        echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

                                                                        if ($row['status'] == 3 || $row['status'] == 'TXN_SUCCESS' || $row['status'] == 'SUCCESS') {
                                                                            $sts = 'Success';
                                                                            $cls = "badge badge-success";
                                                                        } else {
                                                                            $sts = 'Failed';
                                                                            $cls = "badge badge-danger";
                                                                        }
                                                                        echo "<td>
                                                                        <button class='$cls'>" . $sts . "</button>";
                                                                        if ($sts == 'Scanning') {
                                                                            echo '<button class="btn btn-success ml-2 updatetxnstbtn" data-txnid="' . $row['order_id'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                                                        }
                                                                        echo "</td>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="txnupdatemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Update Transaction Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="updatetxnorderform" class="mb-2">
                                        <input type="hidden" name="orderid" id="orderid">
                                        <input type="hidden" name="type" value="updateTxnOrder">

                                        <div class="row">

                                            <div class="col-md-6 mb-2">
                                                <label>Select Status</label>
                                                <select name="status" id="status" class="form-control" required="">
                                                    <option value="" selected disabled>--Select--</option>
                                                    <option value="1">Approved</option>
                                                    <option value="0">Rejected</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>UTR No</label>
                                                <input type="number" name="utrno" id="utrno" class="form-control" placeholder="Enter UTR Number">

                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Remark</label>
                                                <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remarks">

                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>&nbsp;</label>

                                                <button type="submit" name="updatetxnbtn" class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="txndetailsModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-body">

                                    <div class="modal-box">
                                        <div class="modal-header1">Transaction Report</div>
                                        <div class="modal-subheader">Quickly check & analyise your transactions.</div>

                                        <div class="modal-details" id="modalDetails" style="display: block;">
                                            <h6>Details</h6>
                                            <div class="modal-details-grid">

                                                <p class="label">Total Transactions</p>
                                                <p id="totaltxn" class="value">₹ 0.00</p>
                                                <p class="label">Success Transactions</p>
                                                <p id="successtxn" class="value">₹ +0.00</p>
                                                <p class="label">Failed Transactions</p>
                                                <p id="failedtxn" class="value">₹ -0.00</p>

                                                <hr style="border: 1px solidrgb(165, 165, 165); margin: 10px 0;">
                                                <hr style="border: 1px solidrgb(165, 165, 165); margin: 10px 0;">

                                                <h6 class="">Count of txn</h6>
                                                <p> </p>

                                                <p class="label">Total Transactions</p>
                                                <p id="totaltxnc" class="value">0</p>
                                                <p class="label">Success Transactions</p>
                                                <p id="successtxnc" class="value">0</p>
                                                <p class="label">Failed Transactions</p>
                                                <p id="failedtxnc" class="value">0</p>

                                            </div>
                                        </div>

                                        <div class="modal-buttons">
                                            <button class="cancel-button" data-dismiss="modal">Close</button>
                                            <button id="printbtn" class="confirm-button">Print</button>
                                            <form action="txn_overview" method="post">
                                                <input type="hidden" id="frdate" name="from_date" value="<?php echo $_POST['from_date']; ?>">
                                                <input type="hidden" id="endate" name="to_date" value="<?php echo $_POST['to_date']; ?>">
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    </body>
                    <!-- Essential javascripts for application to work-->
                    <script src="js/jquery-3.2.1.min.js"></script>
                    <script src="js/popper.min.js"></script>
                    <script src="js/bootstrap.min.js"></script>
                    <script src="js/main.js"></script>
                    <!-- The javascript plugin to display page loading on top-->
                    <script src="js/plugins/pace.min.js"></script>
                    <!-- Page specific javascripts-->
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
                    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

                    <!-- DataTables Buttons extension for Export to Excel -->
                    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
                    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

                    <script>
                        $(document).on('click', '.updatetxnstbtn', function() {
                            let orderid = $(this).data("txnid");
                            $("#orderid").val(orderid);
                            $("#txnupdatemodal").modal("show");
                        });

                        $("#updatetxnorderform").submit(function(e) {
                            e.preventDefault();
                            $('#loading_ajax').fadeIn();

                            $.ajax({
                                url: 'backend/MerchantAuthController.php',
                                type: 'POST',
                                data: new FormData(this),
                                processData: false,
                                contentType: false,
                                success: function(data, status) {
                                    $('#loading_ajax').fadeOut();
                                    let rslt = JSON.parse(data);

                                    if (rslt.status == 1) {

                                        Swal.fire({
                                            icon: "success",
                                            title: "Success",
                                            button: "Close",
                                            text: rslt.msg,
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {

                                        Swal.fire({
                                            icon: "error",
                                            title: "OOPS..!",
                                            button: "Close",
                                            text: rslt.msg,
                                        });

                                    }

                                },
                                error: function(err) {
                                    $('#loading_ajax').fadeOut();
                                    Swal.fire({
                                        icon: "error",
                                        title: "OOPS..!",
                                        button: "Close",
                                        text: 'some internel error occured we are fixing it',
                                    });

                                }
                            });

                        });

                        var printbtn = document.getElementById("printbtn");
                        var section = document.getElementById("modalDetails").innerHTML;
                        var body = document.querySelector('body').innerHTML;

                        printbtn.addEventListener("click", (e) => {
                            document.body.innerHTML = section;
                            window.print();
                            document.body.innerHTML = body;
                            $('#loading_ajax').fadeOut();
                        });

                        $(document).ready(function() {
                            $("#dataTable").DataTable({
                                dom: 'Bfrtip', // Include button container
                                buttons: [{
                                    extend: 'excelHtml5',
                                    text: 'Export to Excel',
                                    titleAttr: 'Export to Excel',
                                    className: 'btn btn-sm btn-primary'
                                }],
                                order: [
                                    [3, "desc"]
                                ]
                            });
                        });

                        $("#viewtxndetailsBtn").click(function() {

                            $('#loading_ajax').fadeIn();

                            let fromdate = $("#fdate").val();
                            let todate = $("#edate").val();

                            $("#frdate").val(fromdate);
                            $("#endate").val(todate);

                            $.ajax({
                                url: 'backend/user_settings',
                                type: 'POST',
                                data: {
                                    fromdate,
                                    todate,
                                    type: 'txnrdetails'
                                },
                                success: function(data) {

                                    $('#loading_ajax').fadeOut();
                                    let rslt = JSON.parse(data);
                                    if (rslt.res_code == 200) {
                                        $(".modal-subheader").html(rslt.msg);
                                        $("#totaltxn").html(rslt.txndata.totaltxn);
                                        $("#totaltxnc").html(rslt.txndata.totaltxnc);
                                        $("#successtxn").html(rslt.txndata.totalstxn);
                                        $("#successtxnc").html(rslt.txndata.totalstxnc);
                                        $("#failedtxn").html(rslt.txndata.totalftxn);
                                        $("#failedtxnc").html(rslt.txndata.totalftxnc);
                                        $("#txndetailsModal").modal("show");
                                    } else {
                                        popup_error('error', 'OopS!', rslt.msg);
                                    }
                                },
                                error: function(err) {
                                    $('#loading_ajax').fadeOut();
                                    Swal.fire({
                                        icon: "error",
                                        title: "OOPS..!",
                                        button: "Close",
                                        text: 'some internel error occured we are fixing it',
                                    });
                                }
                            })

                        });
                    </script>

                    <link href="https://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
                    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $(".datepicker").datepicker({
                                dateFormat: "yy-mm-dd"
                            });
                        });
                    </script>

</html>
