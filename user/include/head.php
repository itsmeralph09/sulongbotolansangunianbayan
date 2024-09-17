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

    <title>PCBBOT - User</title>
    <link rel="icon" type="image/x-icon" href="../img/pcb.png">

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

        .radio-selection {
            display: flex;
            flex-flow: row wrap;
        }
        .radio-option {
            flex: 1;
            padding: 0.5rem;
        }
        .radio-option input[type="radio"] {
            display: none;
        }
        .radio-option input[type="radio"]:not(:disabled) ~ .radio-label {
            cursor: pointer;
        }
        .radio-option input[type="radio"]:disabled ~ .radio-label {
            color: hsla(150, 5%, 75%, 1);
            border-color: hsla(150, 5%, 75%, 1);
            box-shadow: none;
            cursor: not-allowed;
        }
        .radio-label {
            height: 100%;
            display: block;
            background: white;
            border: 2px solid hsla(150, 75%, 50%, 1);
            border-radius: 20px;
            padding: 1rem;
            margin-bottom: .5rem;
            text-align: center;
            box-shadow: 0px 3px 10px -2px hsla(150, 5%, 65%, 0.5);
            position: relative;
        }
        .radio-option input[type="radio"]:checked + .radio-label {
            background: hsla(150, 75%, 50%, 1);
            color: hsla(215, 0%, 100%, 1);
            box-shadow: 0px 0px 20px hsla(150, 100%, 50%, 0.75);
        }
        .radio-option input[type="radio"]:checked + .radio-label::after {
            color: hsla(215, 5%, 25%, 1);
            font-family: FontAwesome;
            border: 2px solid hsla(150, 75%, 45%, 1);
            content: "\f00c";
            font-size: 24px;
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            height: 50px;
            width: 50px;
            line-height: 50px;
            text-align: center;
            border-radius: 50%;
            background: white;
            box-shadow: 0px 2px 5px -2px hsla(0, 0%, 0%, 0.25);
        }
        .radio-option input[type="radio"]#control_05:checked + .radio-label {
            background: red;
            border-color: red;
        }
        .radio-title {
            margin-top: 1rem;
            font-size: .9rem;
        }
        .radio-description {
            font-weight: 900;
        }
        @media only screen and (max-width: 700px) {
            .radio-selection
    </style>

</head>