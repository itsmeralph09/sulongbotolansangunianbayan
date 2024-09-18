<?php 
require 'function/check_session.php';

// Call the checkSession function to perform session validation
checkSession();
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SZP - Sulong Botolan</title>
    <link rel="icon" type="image/x-icon" href="../img/SZP.png">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Font awesome cdn -->
    <script src="https://kit.fontawesome.com/a5fa2fa3ce.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js" integrity="sha256-+0Qf8IHMJWuYlZ2lQDBrF1+2aigIRZXEdSvegtELo2I=" crossorigin="anonymous"></script>

    <!-- lightbox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox-plus-jquery.min.js" integrity="sha512-U9dKDqsXAE11UA9kZ0XKFyZ2gQCj+3AwZdBMni7yXSvWqLFEj8C1s7wRmWl9iyij8d5zb4wm56j4z/JVEwS77g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    
    <style>
        .input-error {
            border: 1px solid red !important;
        }
        .custom-readonly-input {
            font-style: italic;
            border: none;
            border-bottom: 1.2px solid #303991;
/*            border: 1.2px solid #303991;*/
            border-radius: 0;
            background-color: rgba(48, 57, 145, 0.06);
/*            padding-left: 0;*/
        }

        .custom-readonly-input:focus {
            font-weight: bold;
            font-style: italic;
            outline: none;
            box-shadow: none;
            border: none;
            border-bottom: 1.2px dashed #303991;
            border-radius: 0;
            background-color: transparent;
/*            padding-left: 0;*/
        }
        body.swal2-shown > [aria-hidden='true'] {
          transition: 0.1s filter;
          filter: blur(3px);
        }

        .result-container {
            margin-top: 20px;
        }
        .result-card {
    border: 1px solid #ddd;
    border-radius: 12px;
    margin-bottom: 20px;
    text-align: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    height: auto; /* Allow cards to adjust height based on content */
    background-color: #fff; /* Ensure background is white for printing */
    position: relative; /* Needed for absolute positioning of the image */
    min-height: 250px;
    max-height: 250px;
}


        .result-card img {
            width: 100px;
            height: 100px;
            position: absolute;
            top: 0px;
            left: 0px;

        }

        /* Green star icon for top two vote holders */
        .highlight::before {
            content: '★'; /* Unicode star character */
            position: absolute;
            top: 10px;
            right: 10px;
            color: green;
            font-size: 24px;

        }
        .highlight {
    background-color: #7fffce; /* Light green background */
    border: 2px solid green; /* Green border */
    color: black; /* Ensure text is readable on light green background */
}

/* Light red border for non-top cards */
.non-top {
    border-color: lightcoral;
}
         .result-card h5{
            color: #000; /* Black text color for better readability */
            margin-top: 90px; /* Space for image and star */
        }
        .non-top {
            border-color: lightcoral; /* Light red border for non-top cards */
        }

        .check-icon {
            color: white;
            font-size: 24px;
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: green;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chart-container {
            margin-top: 30px;
        }
        .chart-container canvas {
            max-height: 600px;
            min-height: 300px;
        }
        .print-button {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .print-button-container {
            text-align: right;
        }
@media print {
    .print-button {
        display: none;
    }
    .container-fluid {
        margin-top: 0;
    }

    /* Grid layout for cards: 2 rows, 4 columns */
    .result-container {
        display: run-in;
        grid-template-columns: repeat(4, 1fr); /* 4 equal columns */
        grid-auto-rows: auto; /* Auto-adjust row height */
        gap: 20px; /* Spacing between cards */
        margin-bottom: 30px; /* Space between cards and chart */
    }

    /* Card styling */
    .result-card {
        border: 1px solid #ddd;
        border-radius: 12px;
        background-color: #fff;
        text-align: center;
        padding: 10px;
        height: auto; /* Auto height */
        page-break-inside: avoid; /* Prevent breaking across pages */
    }
    .card-title{
        font-weight: bold;
    }
    .card-text{
        font-size: 30px;
        top:5px;
    }
  .result-card img {
            width: 247px;
            height: 247px;
            position: absolute;
            top: 0px;
            left: 0px;
        }
    /* Chart spans entire row */
    .chart-container {
        grid-column: span 4; /* Chart takes full width after cards */
        margin-top: 30px;
    }

    /* Hide sidebar if exists */
    #wrapper .sidebar,
    #wrapper #sidebar {
        display: none !important;
    }

    #content-wrapper {
        margin-left: 0 !important;
    }
       .highlight {
    background-color: #7fffce; /* Light green background */
    border: 2px solid green; /* Green border */
    color: black; /* Ensure text is readable on light green background */
}

/* Light red border for non-top cards */
.non-top {
    border-color: lightcoral;
}
}




    </style>

</head>