<?php
error_reporting(0);
include "header.php"; ?>

<style>
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #40446e;
        border-bottom: 1px solid #ddd;
    }

    .container-fluid {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        margin: 10px;
        min-width: 250px; /* Minimum width for cards */
    }

    @media (max-width: 768px) {
        .container-fluid {
            flex-direction: column; /* Stack cards on smaller screens */
        }
    }
    
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
                margin-left: 10px;  /* Smaller margin for mobile */
                margin-right: 10px; /* Smaller margin for mobile */
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
            background:#eeeeee;
            border: 1px solid #e1e5ec;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
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
            font-weight: normal;
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
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        
         .modal-details .discountprice {
            color: #D1291A;
            margin-top: 0px;
        }
        
        #discbox,.discountpricelabel,.discountprice{
            display: none;
        }
        
  #couponcodeibox{
    display: none;
    width: 140%;
    margin: 10px 0;
        }
        
  span#applycouponbtn {
    font-weight: bold;
    color: #25a6a1;
    letter-spacing: 0.3px;
    cursor: pointer;
}

.couponinputp{
    display: none;
}
</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cart-plus"></i> Subscription</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
        </ul>
    </div>
    <div class="tile mb-4">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-panel">
                        <div class="content">
                            <div class="container-fluid">
                                <!--<h4 class="page-title">Subscription & Plans</h4>-->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($planname == 'Trial'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Trial Plan</h4>
                                                <h2 class="text-center">₹1299</h2>
                                                <p class="card-category">Per 28 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                    <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 4999 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
            </svg>
            Intent Button System
        </p>
    </td>
</tr>

                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect All Merchant</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">25% OFF</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                               
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="1299" data-planid="1"><?php echo ($userdata["plan_id"] == '1') ? 'Renew' : 'Upgrade Plan' ?></button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($planname == 'Standard'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Standard Plan</h4>
                                                <h2 class="text-center">₹1999</h2>
                                                <p class="card-category">Per 28 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                    <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 8599 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
</svg> Intent Button System</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect All Merchant</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">50% OFF</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                               
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="1999" data-planid="2"><?php echo ($userdata["plan_id"] == '2') ? 'Renew' : 'Upgrade Plan' ?></button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($planname == 'Business'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Business Plan</h4>
                                                <h2 class="text-center">₹2499</h2>
                                                <p class="card-category">Per 28 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                   <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 11999 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
</svg> Intent Button System</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect All Merchant</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">75% OFF</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                                
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="2499" data-planid="3"><?php echo ($userdata["plan_id"] == '3') ? 'Renew' : 'Upgrade Plan' ?></button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($planname == 'Enterprise'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Premium Plan</h4>
                                                <h2 class="text-center">₹4999</h2>
                                                <p class="card-category"> Per 28 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                   <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 24999 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
</svg> Intent Button System</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect All Merchant</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">Free</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                               
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="4999" data-planid="4"><?php echo ($userdata["plan_id"] == '4') ? 'Renew' : 'Upgrade Plan' ?></button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($userdata["plan_id"] == '5'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Enterprise Starter</h4>
                                                <h2 class="text-center">₹3899</h2>
                                                <p class="card-category">Per 84 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                   <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 16499 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
</svg> Intent Button System</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect 10 Merchants</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">Free</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                               
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="3899" data-planid="5"><?php echo ($userdata["plan_id"] == '5') ? 'Renew' : 'Upgrade Plan' ?></button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($userdata["plan_id"] == '6'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Enterprise Pro</h4>
                                                <h2 class="text-center">₹5999</h2>
                                                <p class="card-category">Per 84 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                   <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 28399 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
</svg> Intent Button System</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect 20 Merchants</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">Free</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                               
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="5999" data-planid="6"><?php echo ($userdata["plan_id"] == '6') ? 'Renew' : 'Upgrade Plan' ?></button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($userdata["plan_id"] == '7'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Enterprise Premium</h4>
                                                <h2 class="text-center">₹7499</h2>
                                                <p class="card-category">Per 84 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                   <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 39599 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
</svg> Intent Button System</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect 50 Merchants</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">Free</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                               
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="7499" data-planid="7"><?php echo ($userdata["plan_id"] == '7') ? 'Renew' : 'Upgrade Plan' ?></button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-header <?php if($userdata["plan_id"] == '8'){ echo "activated"; } ?>">
                                                <h4 class="card-title">Enterprise Ultimate</h4>
                                                <h2 class="text-center">₹14999</h2>
                                                <p class="card-category">Per 84 Days</p>
                                            </div>
                                            <div class="card-body">
                                                <table class="mx-auto">
                                                   <tbody>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <!--<td><p> 82499 QR Code Request</p></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> Dynamic QR Code</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-piggy-bank" viewBox="0 0 16 16">
  <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"/>
  <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"/>
</svg> No Amount Limit</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-send-check" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
</svg> Intent Button System</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-link-45deg" viewBox="0 0 16 16">
  <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
  <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
</svg> Payment Link Create</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
</svg> Payment Pages Create</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-bank2" viewBox="0 0 16 16">
  <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
</svg> Connect Unlimited Merchants</p></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                            <td><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>
 No imb Pay Branding</p></td>
                                                        </tr>
                                                        
                                                        <tr>
    <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
    <td>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#40446e" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            Plugin Store <span style="color: #FF5733; font-weight: bold; background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">Free</span>
        </p>
    </td>
</tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                               
                                                    <button class="btn btn-success btn-block subscbtn" data-amount="14999" data-planid="8"><?php echo ($userdata["plan_id"] == '8') ? 'Renew' : 'Upgrade Plan' ?></button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Confirmation Modal -->
<div class="modal fade" id="subsconfirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <div class="modal-body">
                
    <div class="modal-box">
        <div class="modal-header1">Confirm your payment</div>
        <div class="modal-subheader">Quickly and secure, free transactions.</div>

               <div class="modal-details" id="modalDetails" style="display: block;">
            <h6>Details</h6>
            <div class="modal-details-grid">
                <p class="label">Name</p>
                <p id="Name"><?= $userdata["name"] ?></p>
                <p class="label">Mobile</p>
                <p id="Mobile"><?= substr($userdata["mobile"],0,3) ?>XXXX<?= substr($userdata["mobile"],-3) ?></p>
                <p class="label">Plan Pack</p>
                <p id="Plan">Stater</p>
                <p class="label">Plan Expiry Date</p>
                <p id="PlanExipre"></p>
                <p class="label">Payment Method</p>
                <p id="paymentMethod">UPI</p>
                <p class="label">Purchase Date</p>
                <p id="paymentDate"><?= date("M d, Y") ?></p>

                <hr style="border: 1px solidrgb(165, 165, 165); margin: 10px 0;">
                <hr style="border: 1px solidrgb(165, 165, 165); margin: 10px 0;">
               
                
                <p class="label">Price  :  </p>
                <p id="price" class="price">₹1000.00</p>
                <p class="label">GST Charge  :  </p>
                <p id="gstprice" class="gstcharge">₹1000.00</p>
    
                <p class="label discountpricelabel">Discount  :  </p>
                <p id="discountprice" class="discountprice">-₹0.00</p>
    
                <p class="label">Total Amount:</p>
                <p id="paymentAmount" class="total">₹1000.00</p>
            </div>
        </div>
        
        <div class="modal-buttons">
            <button class="cancel-button" data-dismiss="modal">Cancel Payment</button>
             <form method="POST" action="lib/pay">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input type="hidden" class="csubsamount" name="amount" value="1000">
                <input type="hidden" class="csplanid" name="planid" value="2">
                <input type="hidden" class="csdiscountamount" name="discountamount" value="0">
               <button name="upigate" id="confirmButton" class="confirm-button">Confirm Payment</button>
            </form>
        </div>
            </div>
           
        </div>
    </div>
  </div>
</div>


<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/mainscript.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
    
<script>

function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}

function addMonths(date, months) {
        date.setMonth(date.getMonth() + months);
        return date;
    }
    
    function calculateGST(amount) {
    const gstRate = 0.18;
    const gstAmount = amount * gstRate;
    const totalAmount = amount + gstAmount;

    return {
        gstAmount: gstAmount.toFixed(2),
        totalAmount: totalAmount.toFixed(2)
    };
}


let planname = 'Not Found';
let totalprice = 0;
let discount = 0;
let monthsToAdd = 0;


$(document).on('click','.subscbtn',function(){
    
    let planid = $(this).data('planid');
    let amount = $(this).data('amount');
    let calcamount = calculateGST(amount);
    totalprice = parseFloat(calcamount.totalAmount);
    
    
    switch(planid){
        case 1 :
        planname = 'Trial Plan';
        monthsToAdd = 1;
        break;
        case 2 :
        planname = 'Standard Plan';
        monthsToAdd = 3;
        break;
        case 3 :
        planname = 'Business Plan';
        monthsToAdd = 6;
        break;
        case 4 :
        planname = 'Premium Plan';
        monthsToAdd = 12;
        break;
        case 5 :
        planname = 'Enterprise Starter Plan';
        monthsToAdd = 1;
        break;
        case 6 :
        planname = 'Enterprise Pro Plan';
        monthsToAdd = 1;
        break;
        case 7 :
        planname = 'Enterprise Premium Plan';
        monthsToAdd = 1;
        break;
        case 8 :
        planname = 'Enterprise Ultimate Plan';
        monthsToAdd = 1;
        break;
    }
    
    <?php if($userdata["expiry"] > date("Y-m-d")){ ?>
    const today = new Date('<?= $userdata["expiry"] ?>');
    <?php }else{ ?>
    const today = new Date();
    <?php } ?>
    const newDate = formatDate(addMonths(today, monthsToAdd));
    
    $('#Plan').text(planname);
    $('#price').text(`₹ ${amount}.00`);
    $('#gstprice').text(`₹ ${calcamount.gstAmount}`);
    $('#paymentAmount').text(`₹ ${totalprice}`);
    $('#PlanExipre').text(newDate);
    
    $(".csplanid").val(planid);
    $(".csubsamount").val(totalprice);
    
    $("#subsconfirmModal").modal('show');
    
});

</script>

</body>	
</html>	
