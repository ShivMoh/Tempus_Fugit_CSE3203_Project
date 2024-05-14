
@vite(['resources/js/app.js'])
<!-- @vite(['resources/css/inventory/item.css']) -->

<head>
    <style>
        .container{
            background-color: #aad6ec;
        }

        .img{
            background-color: white;
            width: 25%;
        }
        .img img{
            height: 234px;
        }


        .preview{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .info{
            padding: 30px;
            width: 65%;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="preview">
            <div class="img">
                <img src="{{$item->image_url}}" alt="">
            </div>
            <div class="info">
                <h3>{{$item->name}}</h3>
                <div class="details">
                    <h5>Selling Price per unit: ${{$item->selling_price}}</h5>
                    <h5>Cost Price per unit: ${{$item->cost_price}}</h5>
                    <h5>Remaining Stock: {{$item->stock_count}}</h5>
                </div>
            </div>
            
        </div>
    </div>
</body>


    