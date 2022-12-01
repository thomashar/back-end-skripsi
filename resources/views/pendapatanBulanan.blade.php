<!DOCTYPE html> 
 <html> 
 <head> 
         <title>Laporan Pendapatan Bulanan</title> 
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
 </head> 
 <body> 
        <style type="text/css"> 
                 * {
                box-sizing: border-box;
                }

                body {
                background-color: #fafafa;
                }

                .report-container {
                font-family: "Open Sans";
                margin-top: 25px;
                max-width: 1240px;
                margin: 25px auto 25px auto;
                background-color: #fff;
                min-height: 20px;
                border: 1px solid #eaeaea;
                font-size: 0.9rem;
                }

                .report-controls {
                display: flex;
                flex: 1 1 auto;
                background-color: #f1f6fb;
                padding: 0px;
                width: 100%;
                border-bottom:1px solid #e4e4e4;
                }

                .controls-left {
                margin-right: auto;
                }

                .controls-right {
                margin-left: auto;
                }

                .report-controls .report-dropdown {
                display: inline-block;
                }

                .report-controls button.report-button {
                padding: 10px;
                background-color: transparent;
                border: none;
                color: #666;
                }

                .report-controls button.report-button:hover,
                .report-controls button.report-button:focus {
                background-color: rgba(0, 0, 170, 0.05);
                }

                .report-dropdown {
                position: relative;
                }

                .report-dropdown .report-dropdown-menu {
                display: none;
                position: absolute;
                z-index: 1;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1);
                border: 1px solid #e4e4e4;
                border-radius: 4px;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
                overflow: hidden;
                }

                .report-controls .controls-right .report-dropdown .report-dropdown-menu {
                right: 0;
                }

                .report-dropdown .report-dropdown-menu .report-dropdown-item {
                display: block;
                text-decoration: none;
                padding: 6px 12px;
                color: #444;
                font-size: 0.9em;
                }

                .report-dropdown .report-dropdown-menu .report-dropdown-item:first-child {
                padding-top: 8px;
                }

                .report-dropdown .report-dropdown-menu .report-dropdown-item:last-child {
                padding-bottom: 8px;
                }

                .report-dropdown .report-dropdown-menu .report-dropdown-item:hover,
                .report-dropdown .report-dropdown-menu .report-dropdown-item:focus {
                background-color: #d0e2f4;
                }

                .report-dropdown:hover .report-dropdown-menu,
                .report-dropdown:focus .report-dropdown-menu {
                display: block;
                }

                .report-container .color-red {
                color: red;
                }

                .report-container .color-green {
                color: green;
                }

                .report-container .color-blue {
                color: blue;
                }

                .report-container .color-orange {
                color: orange;
                }

                .report-container .f-right {
                float: right;
                }

                .report-header{
                color: #555;
                }

                .report-title {
                text-align: center;
                font-weight: 300;
                margin-bottom: 30px;
                margin-top: 30px;
                }

                .report-name {
                text-align: center;
                text-transform: uppercase;
                font-size: 1.1em;
                color: #555;
                letter-spacing: 1px;
                margin-bottom:30px;
                }

                .report-name small{
                font-size:.9em;
                font-weight:400;
                display:block;
                margin-top:15px;
                text-transform:none;
                }

                .report-body{
                padding:10px 15px;;
                }

                .report-body table{
                width:100%;
                table-layout:fixed;
                border-collapse:collapse;
                }

                .report-body table thead th{
                font-weight:bold;
                border-top:1px solid #444;
                border-bottom:1px solid #444;
                padding:6px 10px;
                border-right:1px dotted #bbb;
                }

                .report-body table thead th:last-child{
                border-right:none;
                }

                .report-body table tbody tr td{
                font-size:.9em;
                padding:8px 6px;
                white-space:nowrap;
                overflow:hidden;
                text-overflow:ellipsis;
                }

                .report-body table tbody tr.tr-primary td {
                padding-bottom:10px;
                }

                .report-body table tbody tr.tr-primary td:hover{
                background-color:rgba(0,0,0,0.05)
                }

                .report-body table tbody tr.tr-primary.open + .tr-secondary,
                .report-body table tbody tr.tr-primary.open + .tr-secondary + .tr-total{
                display:table-row;
                }

                .report-body table tbody tr.tr-primary.open .report-collapse-trigger i{
                transform:rotate(45deg);
                }

                .report-body table tbody tr.tr-secondary,.report-body table tbody tr.tr-total{
                display:none;
                }

                .report-body table tbody tr.tr-secondary td {
                border-bottom:1px solid #ddd;
                }

                .report-body table tbody tr.tr-secondary td:first-child{
                padding-left:30px;
                }

                .report-collapse-trigger{
                padding:0px;
                cursor:pointer;
                margin-right:.25rem;
                background:none;
                border:none;
                text-decoration:none;
                color:#999;

                }

                .report-collapse-trigger i{
                transition:all .3s ease;
                transform:rotate(0deg);
                }

                .report-collapse-trigger:hover,
                .report-collapse-trigger:focus{
                color:blue;
                }


                .report-body table tbody tr.tr-total{
                font-weight:bold;
                color:#444;
                }

                .report-body table tbody tr.tr-total td{
                padding-bottom:14px;
                }

                .report-body table tfoot th{
                padding:8px 6px;
                border-top:1px solid #999;
                border-bottom:2px solid #555;
                }

                .text-left{
                text-align:left;
                }


                .text-right{
                text-align:right;
                }

                .text-center{
                text-align:center;
                }

                .report-timestamp{
                margin:20px 0px 30px;
                }
        </style> 
     
 
	<div class="report-container">
                <div class="report-content">
                        <div class="report-header">
                                <h1 class="report-title">SIKafe</h1>

                                <h3 class="report-name">Penjualan Menu dan Pendapatan Bulanan</h3>
                        </div>

                        <div class="report-body">
                        <table>
                                <thead>
                                        <tr>
                                                <th>No.</th>
                                                <th>Nama Menu</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        @php $i=1 @endphp 
                                        @foreach($penjualan as $p) 
                                        <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $p->nama_menu }}</td>
                                                <td>{{ $p->Jumlah }}</td>
                                                <td>{{ $p->harga_menu }}/pcs</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                        <th></th>
                                        <th></th>
                                        <th>TOTAL(termasuk PPN)</th>
                                        <th>{{ $pendapatan }}</th>
                                </tr>
                                </tfoot>
                        </table>
                        </div>
                </div>
        </div>
 
</body>
</html>
