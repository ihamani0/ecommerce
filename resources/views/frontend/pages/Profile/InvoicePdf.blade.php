<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .font{
            font-size: 15px;
        }
        .authority {
            /*text-align: center;*/
            float: right
        }
        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }
        .thanks p {
            color: green;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>
<body>

<table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
            <!-- {{-- <img src="" alt="" width="150"/> --}} -->
            <h2 style="color: green; font-size: 24px;"><strong>eCommerce-Setif</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               eCommerce-Setif Head Office
               Email:issam.ess556@gmail.com <br>
               Mob: 0697096705 <br>
               Setif 1207,lararsa:#10 <br>

            </pre>
        </td>
    </tr>

</table>


<table width="100%" style="background:white; padding:2px;"></table>

<table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
            <p class="font" style="margin-left: 20px;">
                <strong>Name:</strong> {{$order->name}} <br>
                <strong>Email:</strong> {{$order->email}} <br>
                <strong>Phone:</strong> {{$order->phone_number}} <br>

                <strong>Address:</strong> {{$order->address}} <br>
                <strong>Post Code:</strong> {{$order->code_post}}
            </p>
        </td>
        <td>
            <p class="font">
                <h3><span style="color: green;">Invoice:</span> #{{$order->invoice_number}}</h3>
                Order Date: {{$date}} <br>
                Delivery Date: <br>
                Payment Type : {{$order->payment_method}} <br>
            </p>
        </td>
    </tr>
</table>
<br/>
<h3>Products</h3>


<table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
    <tr class="font">
        <th>Nu</th>
        <th>Product Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
    </tr>
    </thead>
    <tbody>

    @foreach($OrderItems as $item)


    <tr class="font">
        <td>{{$loop->iteration}}</td>
        {{--<td align="center">
          <img src="{{ public_path('storage/'.str_replace('public/', '', $item->product->product_thumbnail)) }}"
                 height="60px;" width="60px;" alt="">
        </td>--}}
        <td align="center">{{$item->product->product_name}}</td>

        <td align="center">{{$item->color ? $item->color : '.'}}</td>
        <td align="center">{{$item->size ? $item->size : '.' }}</td>
        <td align="center">{{$order->order_number}}</td>
        <td align="center">{{$item->qty}}</td>
        <td align="center">{{$item->price}}</td>
        <td align="center">
            {{$item->price * $item->qty }}
        </td>
    </tr>

    @endforeach
    </tbody>
</table>
<br>
<table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: green;">Subtotal:</span>{{$order->amount}}</h2>
            <h2><span style="color: green;">Total:</span>{{$order->amount}}</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
</table>
<div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
</div>
<div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
</div>
</body>
</html>
