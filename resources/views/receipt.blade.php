<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
    <style type="text/css">
        td, th {
            border-width: 80px;
        }
        body{
            margin-top:20px;
            background:#eee;
        }
        .invoice {
            background: #fff;
            padding: 20px
        }
        .invoice-company {
            font-size: 20px
        }
        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px
        }
        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }
        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }
        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }
        .invoice-date {
            text-align: right;
            padding-left: 20px
        }
        .invoice-price {
            background: #f0f3f4;
            display: table;
            width: 100%
        }
        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }
        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }
        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }
        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }
        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }
        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }
        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }
        .invoice-note {
            color: #999;
            margin-top: 80px;
            font-size: 85%
        }
        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }
        .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-arrow-circle-o-left"></i> Previous page</a>
            <a href="{{route('home')}}" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-home"></i>&nbsp;Home</a>
            <a href="javascript:;" id="btn_pdf" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
            <a href="javascript:;" onclick="printDiv('invoice')" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
        </div>
    </div>
    <div class="container">
     <div class="col-md-12">
      <div class="invoice" id="invoice">
       <div class="text-center">
        <b>ABDUL MONEM LTD</b><br>
        <small>Monem Business District, 111, Bir Uttam CR Datta (Sonargaon) Road, Dhaka-1205</small>
    </div>
    <br>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table border border-dark" width="400" height = "680" table-layout = "auto">
                <tr>
                    <td colspan="3" align="center" style="height: 5%;"><b>LAPTOP RECEIVE FORM</b></td>
                    <td colspan="1" style="height: 5%;"><b>ISSUE DATE: {{$time}} <br> ASSET NO: {{$invoice->asset_no}}</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="height:10%;"><b>Name of handover by: &nbsp; {{$invoice->handedBy}} 
                        <br> Designation: &nbsp; {{$invoice->h_desigation}} 
                        <br> Department: &nbsp; {{$invoice->h_dept}} 
                        <br> Unit: &nbsp; {{$invoice->h_unit}}</b>
                    </td>
                    <td colspan="2" style="height:10%;"><b>Name of Takeover by: &nbsp; {{$invoice->takenBy}} 
                        <br> Designation: &nbsp; {{$invoice->t_desigation}} 
                        <br> Department: &nbsp; {{$invoice->t_dept}} 
                        <br> Unit: &nbsp; {{$invoice->t_unit}}</b
                        ></td>
                    </tr>
                    <tr>
                        <td  colspan="1" align="center" style="width: 10%; height: 5%;"> <b>S/L NO</b> </td>
                        <td  colspan="1" align="center" style="width: 50%; height: 5%;"> <b>PRODUCT DESCRIPTION</b> </td>
                        <td  colspan="1" align="center" style="width: 5%; height: 5%;"> <b>QTY</b> </td>
                        <td  colspan="1" align="center" style="width: 35%; height: 5%;"> <b>REMARKS</b> </td>
                    </tr>
                    <tr>
                        <td  colspan="1" align="center" style="width: 10%; height: 100%;"> 1 </td>
                        <td  colspan="1" style="width: 50%; height: 100%;"> <p style="text-align: center;"><b>{{$invoice->laptop_name}}</b></p> Configuration: <br><br> {{$invoice->configuration}} </td>
                        <td  colspan="1" align="center" style="width: 5%; height: 100%;"><br><br><br><br> {{$invoice->qty}} </td>
                        <td  colspan="1" align="center" style="width: 35%; height: 100%;"><br><br><br><br> {{$invoice->remarks}} </td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br>
        <div class="d-flex justify-content-between">
           <span style="text-decoration:overline;">&nbsp;Signature of Handover &nbsp;</span>
           <span style="text-decoration:overline;">&nbsp;Signature of Takeover &nbsp;</span>
       </div>
       <br><br><br>
       <div class="d-flex justify-content-center">
           <span style="text-decoration:overline;">&nbsp;&nbsp;&nbsp; Counter Sign &nbsp;&nbsp;&nbsp;</span>
       </div>
   </div>
</div>
</div>
</body>
</html>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    $(document).ready(function($) 
    { 
        $(document).on('click', '#btn_pdf', function(event) 
        {
            event.preventDefault();
            var element = document.getElementById('invoice'); 
            var opt = 
            {
                margin:       1,
                filename:     'Invoice'+'.pdf',
            };
                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();
            });
    });
</script>