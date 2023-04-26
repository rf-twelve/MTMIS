<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page {
            margin-top: 0.5in;
            margin-left: 0.5in;
            margin-right: 0.5in;
            margin-bottom: 0.5in;
            size: 8.5in 13in;
        }

        /* General
        -----------------------------------------------------------------------*/
        body {
            background-color: transparent;
            color: black;
            font-family: "verdana", "sans-serif";
            margin: 0px;
            padding-top: 0px;
            font-size: 1em;
        }

        @media print {
            p { margin: 2px; }
        }

        table {
            width:100%;
        }
        td {
            padding:2px;
        }

        .table-bordered{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table-bordered th
        {
            border: 1px solid black;
        }
        .table-bordered td, {
            border-right: 1px solid black;
            border-left: 1px solid black;
        }
        .right{
            text-align: right;
        }
        .center{
            text-align: center;
        }
        .bold{
            font-weight: bold;
        }
        .bordered {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .underline {
            border-bottom: 1px solid black;
        }
        .spacing-1 {
            letter-spacing: 1px;
        }
        .spacing-2 {
            letter-spacing: 2px;
        }
        .p-2 {
            padding: 2px;
        }
        .p-4 {
            padding: 4px;
        }
        .w-50 {
            width: 50%;
        }
        .w-60 {
            width: 60%;
        }
        .page-break {
            page-break-after: always;
        }

    </style>
</head>

<body>
    <table style="font-size: 8px">
        <tbody>
            <tr>
                <td width="35%" class="right">
                    <img width="50" src="{{ url('/img/company/logo.png') }}" />
                </td>
                <td width="30%" class="center">
                    <p style="font-size:9pt;">
                        Republic of the Philippines<br>
                        Province of Aklan<br>
                    </p>
                    <p style="font-size:10pt;font-style:bold">
                        ATI-ATIHAN TOWN OF KALIBO<br>
                        MEEDO-BGMD
                    </p>
                </td>
                <td width="35%"></td>
            </tr>
        </tbody>
    </table>
    <p class="center" style="font-size:12pt;font-style:bold;padding:0pt">
       WORK ORDER SLIP
    </p>
    {{--

    <table style="width: 100%; font-size: 9pt;margin-bottom: 2pt;">
        <tr>
            <td rowspan="5" class="" style="width: 10%"><strong>TO:</strong></td>
            <td rowspan="5" class="underline" style="width: 30%"><strong>{{ $assigned_worker }}</strong></td>
            <td rowspan="5" class="" style="width: 10%"></td>
            <td class="" style="width: 15%"><strong>WORK ORDER #:</strong></td>
            <td class="underline" style="width: 25%"><strong>{{ $work_order_no }}</strong></td>
        </tr>
        <tr>
            <td class="" style="width: 15%"><strong>DATE STARTED:</strong></td>
            <td class="underline" style="width: 25%"><strong>{{ $date_started }}</strong></td>
        </tr>
        <tr>
            <td class="" style="width: 15%"><strong>DATE FINISHED:</strong></td>
            <td class="underline" style="width: 25%"><strong>{{ $date_finished }}</strong></td>
        </tr>
        <tr>
            <td class="" style="width: 15%"><strong>VEHICLE TYPE:</strong></td>
            <td class="underline" style="width: 25%"><strong>{{ $vehicle_type }}</strong></td>
        </tr>
        <tr>
            <td class="" style="width: 15%"><strong>PLATE/ENGINE #:</strong></td>
            <td class="underline" style="width: 25%"><strong>{{ $vehicle_plate_engine }}</strong></td>
        </tr>
    </table>
    <p class="center" style="font-size:10pt;font-style:bold;padding:0pt">
        Effective upon receipt hereof, you are directed to undertake the following work/s
        enumerated hereunder:
     </p>

    <table class="bordered" style="font-size: 9pt;border-collapse: collapse;">
        <thead>
            <tr>
                <th class="bordered" style="width:33%">WORK DESCRIPTION</th>
                <th class="bordered" style="width:33%">ESTIMATED MAN-HOURS</th>
                <th class="bordered" style="width:33%">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            <?php $num=1; ?>
            @forelse ($work_descriptions as $item)
                <tr class="even_row">
                    <td class="bordered left">{{ $num++.'. '.$item['description'] }}</td>
                    <td class="bordered center">{{ $item['estimated_man_hours'] }}</td>
                    <td class="bordered left">{{ $item['remarks'] }}</td>
                </tr>
            @empty

            @endforelse
        </tbody>
    </table>

    <table style="width:100%">
        <tr style="font-size:9pt;">
            <td width="15%"><strong>Supervised by:</strong></td>
            <td width="55%" class="underline">{{ $supervised_by }}</td>
            <td width="10%" class="right">Date:</td>
            <td width="20%" class="underline">{{ $supervised_date }}</td>
        </tr>
        <tr style="font-size:9pt;">
            <td width="15%"><strong>Approved by:</strong></td>
            <td width="55%" class="underline">{{ $approved_by }}</td>
            <td width="10%" class="right">Date:</td>
            <td width="20%" class="underline">{{ $approved_date }}</td>
        </tr>
        <tr style="font-size:9pt;">
            <td width="15%"><strong>Received by:</strong></td>
            <td width="55%" class="underline">{{ $received_by }}</td>
            <td width="10%" class="right">Date:</td>
            <td width="20%" class="underline">{{ $received_date }}</td>
        </tr>
    </table> --}}

</body>

</html>
