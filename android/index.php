<html>
<title>
Receiving System
</title>
<head>
    <style>
        body {
          font-family: "Times New Roman", Helvetica, Arial;
          font-size: 16px;
        }

        .text-center {
          text-align: center;
        }

        *, *:before, *:after {
          -webkit-border-sizing: border-box;
          -moz-border-sizing: border-box;
          border-sizing: border-box;
        }

        .container {
          width: 350px;
          margin: 50px auto;
        }
        .container > ul {
          list-style: none;
          padding: 0;
          margin: 0 0 20px 0;
        }

        .title {
          font-family: 'Pacifico';
          font-weight: norma;
          font-size: 40px;
          text-align: center;
          line-height: 1.4;
          color: #2980B9;
        }

        .dropdown a {
          text-decoration: none;
        }
        .dropdown [data-toggle="dropdown"] {
          position: relative;
          display: block;
          color: white;
          background: #2980B9;
          -moz-box-shadow: 0 1px 0 #409ad5 inset, 0 -1px 0 #20638f inset;
          -webkit-box-shadow: 0 1px 0 #409ad5 inset, 0 -1px 0 #20638f inset;
          box-shadow: 0 1px 0 #409ad5 inset, 0 -1px 0 #20638f inset;
          text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);
          padding: 10px;
        }
        .dropdown [data-toggle="dropdown"]:hover {
          background: #2c89c6;
        }
        .dropdown .icon-arrow {
          position: absolute;
          display: block;
          font-size: 0.7em;
          color: #fff;
          top: 14px;
          right: 10px;
        }
        .dropdown .icon-arrow.open {
          -moz-transform: rotate(-180deg);
          -ms-transform: rotate(-180deg);
          -webkit-transform: rotate(-180deg);
          transform: rotate(-180deg);
          -moz-transition: -moz-transform 0.6s;
          -o-transition: -o-transform 0.6s;
          -webkit-transition: -webkit-transform 0.6s;
          transition: transform 0.6s;
        }
        .dropdown .icon-arrow.close {
          -moz-transform: rotate(0deg);
          -ms-transform: rotate(0deg);
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
          -moz-transition: -moz-transform 0.6s;
          -o-transition: -o-transform 0.6s;
          -webkit-transition: -webkit-transform 0.6s;
          transition: transform 0.6s;
        }
        .dropdown .icon-arrow:before {
          content: '\25BC';
        }
        .dropdown .dropdown-menu {
          max-height: 0;
          overflow: hidden;
          list-style: none;
          padding: 0;
          margin: 0;
        }
        .dropdown .dropdown-menu li {
          padding: 0;
        }
        .dropdown .dropdown-menu li a {
          display: block;
          color: #6f6f6f;
          background: #EEE;
          -moz-box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
          -webkit-box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
          box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
          text-shadow: 0 -1px 0 rgba(255, 255, 255, 0.3);
          padding: 10px 10px;
        }
        .dropdown .dropdown-menu li a:hover {
          background: #f6f6f6;
        }
        .dropdown .show, .dropdown .hide {
          -moz-transform-origin: 50% 0%;
          -ms-transform-origin: 50% 0%;
          -webkit-transform-origin: 50% 0%;
          transform-origin: 50% 0%;
        }
        .dropdown .show {
          display: block;
          max-height: 9999px;
          -moz-transform: scaleY(1);
          -ms-transform: scaleY(1);
          -webkit-transform: scaleY(1);
          transform: scaleY(1);
          animation: showAnimation 0.5s ease-in-out;
          -moz-animation: showAnimation 0.5s ease-in-out;
          -webkit-animation: showAnimation 0.5s ease-in-out;
          -moz-transition: max-height 1s ease-in-out;
          -o-transition: max-height 1s ease-in-out;
          -webkit-transition: max-height 1s ease-in-out;
          transition: max-height 1s ease-in-out;
        }
        .dropdown .hide {
          max-height: 0;
          -moz-transform: scaleY(0);
          -ms-transform: scaleY(0);
          -webkit-transform: scaleY(0);
          transform: scaleY(0);
          animation: hideAnimation 0.4s ease-out;
          -moz-animation: hideAnimation 0.4s ease-out;
          -webkit-animation: hideAnimation 0.4s ease-out;
          -moz-transition: max-height 0.6s ease-out;
          -o-transition: max-height 0.6s ease-out;
          -webkit-transition: max-height 0.6s ease-out;
          transition: max-height 0.6s ease-out;
        }

        @keyframes showAnimation {
          0% {
            -moz-transform: scaleY(0.1);
            -ms-transform: scaleY(0.1);
            -webkit-transform: scaleY(0.1);
            transform: scaleY(0.1);
          }
          40% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
          }
          60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
          }
          100% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
          }
          100% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
          }
        }
        @-moz-keyframes showAnimation {
          0% {
            -moz-transform: scaleY(0.1);
            -ms-transform: scaleY(0.1);
            -webkit-transform: scaleY(0.1);
            transform: scaleY(0.1);
          }
          40% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
          }
          60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
          }
          100% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
          }
          100% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
          }
        }
        @-webkit-keyframes showAnimation {
          0% {
            -moz-transform: scaleY(0.1);
            -ms-transform: scaleY(0.1);
            -webkit-transform: scaleY(0.1);
            transform: scaleY(0.1);
          }
          40% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
          }
          60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
          }
          100% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
          }
          100% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
          }
        }
        @keyframes hideAnimation {
          0% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
          }
          60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
          }
          100% {
            -moz-transform: scaleY(0);
            -ms-transform: scaleY(0);
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
          }
        }
        @-moz-keyframes hideAnimation {
          0% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
          }
          60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
          }
          100% {
            -moz-transform: scaleY(0);
            -ms-transform: scaleY(0);
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
          }
        }
        @-webkit-keyframes hideAnimation {
          0% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
          }
          60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
          }
          80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
          }
          100% {
            -moz-transform: scaleY(0);
            -ms-transform: scaleY(0);
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
          }
        }

    </style>
    
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="google" value="notranslate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <!--   <link rel='stylesheet' href='../bootstrap/css/bootstrap.min.css'>
    <script src='../bootstrap/jquery/jquery-1.12.0.min.js'></script>
    <script src='../bootstrap/js/bootstrap.js'></script>-->
</head>
<body>
    <h2 align="center"><img src="../img/jvclogo2.png" alt="Logo: JVCKENWOOD" width="300" height="77"></img></h2>

    <div class="container">
      <h1 class="title">RECEIVING MENU</h1>
      <ul>
        <li class="dropdown">
          <a href="#" data-toggle="dropdown">NON TAPING BARCODE SYSTEM<i class="icon-arrow"></i></a>
          <ul class="dropdown-menu">
            <li><a href="../brcsupp.php">Manual Barcode Printing</a></li>
            <li><a href="../brcsupp_new.php">New Barcode Printing</a></li>
            <li><a href="../frmupload.php">UPLOAD SO DATA - SA90.CSV</a></li>
            <li><a href="../stdlocalsupp.php">Standard Packing Maintenance</a></li>
            <li><a href="../partupdate.php">UPDATE PART AFTER UPLOAD SO DATA</a></li>
            <li><a href="../soview.php">VIEW SO DATA - SA90</a></li>
            <li><a href="../issueview.php">VIEW ACTIVE MONTH DETAIL DATA</a></li>
            <li><a href="scanframe_edit.php">SCAN DATA WITH BARCODE</a></li>			<!-- scanframe android -->
            <li><a href="../manual_so_number.php">Manual SO Number Printing</a></li>
            <li><a href="../issueviewold.php">VIEW OLD DETAIL DATA</a></li>
            <li><a href="../part_category.php">Part Category Maintenance</a></li>
            <li><a href="../part_without_supplier_code.php">Part Without Supplier Code Maintenance</a></li>
            <li><a href="../issue_part_list_non_fa.php">Issue Part List Non FA Printing</a></li>
            <li><a href="../issue_part_list.php">Issue Part List Printing</a></li>
            <li><a href="../sop_non_taping.htm">SOP NON TAPING</a></li>
            <li><a href="../warehouse_layout.htm">RECEIVING WAREHOUSE LAYOUT</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" data-toggle="dropdown">B-CAS ISSUE BARCODE SYSTEM<i class="icon-arrow"></i></a>
          <ul class="dropdown-menu">
            <li><a href="../bcasbarcode.php">SCAN B-CAS</a></li>
            <li><a href="../bcasview.php">VIEW B-CAS DETAIL</a></li>
            <li><a href="../bcasviewdel.php">DELETE B-CAS</a></li>
            <li><a href="../bcasviewdownload.php">DOWNLOAD B-CAS REPORT</a></li>
          </ul>
        </li>
      </ul>
    </div>
   <script>
        var dropdown = document.querySelectorAll('.dropdown');
        var dropdownArray = Array.prototype.slice.call(dropdown,0);
        dropdownArray.forEach(function(el){
            var button = el.querySelector('a[data-toggle="dropdown"]'),
                    menu = el.querySelector('.dropdown-menu'),
                    arrow = button.querySelector('i.icon-arrow');

            button.onclick = function(event) {
                if(!menu.hasClass('show')) {
                    menu.classList.add('show');
                    menu.classList.remove('hide');
                    arrow.classList.add('open');
                    arrow.classList.remove('close');
                    event.preventDefault();
                }
                else {
                    menu.classList.remove('show');
                    menu.classList.add('hide');
                    arrow.classList.remove('open');
                    arrow.classList.add('close');
                    event.preventDefault();
                }
            };
        })

        Element.prototype.hasClass = function(className) {
            return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
        };
    </script> 
</body>
</html>