@vite('resources/js/supplier/request_form.js')
@vite('resources/css/supplier/request_form.css')

<form id="regForm" method="POST" action="/review">
    @csrf
        <div class="row">
            <select name="item" id="item">
                @foreach ($result[0]['items'] as $item)
                    <option value={{$item->id}} selected>{{$item->name}}</option>            
                @endforeach
            </select>
            <p><input placeholder="Amount" type="number" name="amount" id="amount"></p>
            <p class="item-display" id="item-display"></p>
            <input type="hidden" name="items" id="items">
            <input type="hidden" name="supplier" id="supplier" value={{$result[0]['supplier']->id}}>
            <button type="button" onclick="addItem()">Add Item</button>         
        </div>
        
        <div class="row">
            <select name="payment" id="payment">
                @foreach ($result[0]['cards'] as $card)
                    <option value={{$card->id}} selected>{{$card->card_holder}}</option>            
                @endforeach
            </select>
        </div>

        <button type="submit">Submit</button>
            
    </div>
</form>

