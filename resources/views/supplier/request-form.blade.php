@vite('resources/js/supplier/request_form.js')
@vite('resources/css/supplier/request_form.css')

<form id="regForm" method="POST" action="/review">
    @csrf
        <div class="row">
            <div class="title-container">
                <h1 class="section-title">Select Items</h1>
            </div>
            <div class="item-container">

                <div class="input-container">

                    <select name="item" id="item">
                        @foreach ($result[0]['items'] as $item)
                            @php
                                $item_name = str_replace(" ", "_", $item->name);
                                $item_id = $item->id;
                                $item_value = $item_name."x".$item_id;
                            @endphp
                            <option value={{$item_value}}>{{$item->name}}</option>            
                        @endforeach
                    </select>
                    <p><input placeholder="Amount" type="number" name="amount" id="amount"></p>
                </div>
                <button type="button" onclick="addItem()">Add Item</button>             
            </div>

            <p class="item-display" id="item-display"></p>
            <p class="item-displayer" id="item-displayer"></p>

            <input type="hidden" name="items" id="items">
            <input type="hidden" name="supplier" id="supplier" value={{$result[0]['supplier']->id}}>
        </div>
        
        <div class="row">
            <div class="title-container">
                <h1 class="section-title">Select Company Card</h1>
            </div>
            <select name="payment" id="payment">
                @foreach ($result[0]['cards'] as $card)
                    <option value={{$card->id}} selected>{{$card->card_holder}}</option>            
                @endforeach
            </select>
        </div>

        <div class="button-container">
            <button type="submit" class="order-item">Submit</button>
        </div>
            
    </div>
</form>

