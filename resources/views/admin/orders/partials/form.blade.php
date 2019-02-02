<div class="col-sm-12 col-md-6 @if(empty($order)) col-md-offset-3 @endif">
    <div class="form-group">
        <label for="inputClientEmail">E-mail клиента</label>
        <input type="email" class="form-control" name="client_email" id="inputClientEmail"
               value="@if(old('client_email')){{old('client_email')}}@else{{$order->client_email ?? ''}}@endif"
               required/>
        @if($errors->has('client_email'))
            <span class="error">{{$errors->first('client_email')}}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="selectPartner">Партнер</label>
        <select name="partner_id" id="selectPartner" class="form-control" required>
            @foreach($partners as $partner)
                <option value="{{$partner->id}}"
                        @if((old('partner_id') && old('partner_id') == $partner->id) || (!empty($order->partner) && $order->partner->id == $partner->id)) selected @endif>{{$partner->name}}</option>
            @endforeach
        </select>
        @if($errors->has('partner_id'))
            <span class="error">{{$errors->first('partner_id')}}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="selectStatus">Статус</label>
        <select name="status" id="selectStatus" class="form-control" required>
            <option value="0"
                    @if((old('status') && old('status') == 0) || (!empty($order->status) && $order->status == 0)) selected @endif>{{getOrderStatusName(0)}}</option>
            <option value="10"
                    @if((old('status') && old('status') == 10) || (!empty($order->status) && $order->status == 10)) selected @endif>{{getOrderStatusName(10)}}</option>
            <option value="20"
                    @if((old('status') && old('status') == 20) || (!empty($order->status) && $order->status == 20)) selected @endif>{{getOrderStatusName(20)}}</option>

        </select>
        @if($errors->has('partner_id'))
            <span class="error">{{$errors->first('partner_id')}}</span>
        @endif
    </div>
</div>
@if(!empty($order))
    <div class="col-sm-12 col-md-6">
        <div id="products">
            <div class="text-center">Товары:</div>
            @foreach($order->products as $product)
                <ul class="list-unstyled">
                    <li>{{$product->name}} - {{$product->quantity}} шт.</li>
                </ul>
            @endforeach
        </div>
        <div id="total">
            <p><b>Сумма заказа: </b>{{getOrderTotal($order)}}</p>
        </div>
    </div>
@endif