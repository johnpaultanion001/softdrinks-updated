
                    <?php 
                        $subtotal     = $receipts->sum('total_amount_receipt') + $pallets->sum('amount');

                        $total_cost   = $receipts->sum('total') + $pallets->sum('amount');
                        $total_return = $returns->sum('amount') + $return_pallets->sum('amount');

                        $total_amount = $total_cost - $total_return;
                      
                      ?>
                <div class="receipt-body mt--3 p-2" id="receipt-body">
                    <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Articles</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span>
                                                Sales
                                            </span>
                                        </td>
                                    </tr>
                                    @foreach($receipts as $key => $receipt)
                                        <tr>
                                            <td></td>
                                            <td>{{$receipt->purchase_qty ?? ''}}</td>
                                            <td>{{$receipt->product->category->name ?? ''}}</td>
                                            <td>{{$receipt->product->description ?? ''}}</td>
                                            <td>₱ {{ number_format($receipt->product->price ?? '' , 2, '.', ',') }}</td>
                                            <td>₱ {{ number_format($receipt->total_amount_receipt ?? '' , 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($pallets as $pallet)
                                        <tr>
                                            <td></td>
                                            <td>{{$pallet->qty ?? ''}}</td>
                                            <td>PALLET</td>
                                            <td>{{$pallet->pallet->title ?? ''}}</td>
                                            <td>₱ {{ number_format($pallet->unit_price ?? '' , 2, '.', ',') }}</td>
                                            <td>₱ {{ number_format($pallet->amount ?? '' , 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            Total Sales Amt:
                                            <br>
                                            Discounted:
                                            
                                        </td>
                                        <td> 
                                            ₱ {{ number_format($subtotal ?? '' , 2, '.', ',') }}
                                            <br>
                                            ₱ ( {{ number_format($receipts->sum->discounted ?? '' , 2, '.', ',') }} )
                                        </td>
                                    </tr>
                                    <tr>
                                            <td>Returns</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                    </tr>
                                    @foreach($returns as $return)
                                        <tr>
                                            <td></td>
                                            <td>{{$return->return_qty}}</td>
                                            <td></td>
                                            <td>{{$return->product->description ?? 'NO BRAND'}}</td>
                                            <td>₱ {{ number_format($return->unit_price ?? '' , 2, '.', ',') }}</td>
                                            <td>₱ {{ number_format($return->amount ?? '' , 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($return_pallets as $pallet)
                                        <tr>
                                            <td></td>
                                            <td>{{$pallet->qty ?? ''}}</td>
                                            <td>PALLET</td>
                                            <td>{{$pallet->pallet->title ?? ''}}</td>
                                            <td>₱ {{ number_format($pallet->unit_price ?? '' , 2, '.', ',') }}</td>
                                            <td>₱ {{ number_format($pallet->amount ?? '' , 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            Total Return Amt: 
                                                <br>
                                            Total Deposit Amt:
                                        </td>
                                        <td> 
                                            ₱ ( {{ number_format($total_return ?? '' , 2, '.', ',') }} )
                                           <br>
                                            ₱ {{ number_format($total_deposit ?? '' , 2, '.', ',') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            Total: 
                                            <br>
                                            Cash:
                                            <br>
                                            Change:
                                        </td>
                                        <td> 
                                            ₱ {{ number_format($total_amount ?? '' , 2, '.', ',') }}
                                            <br>
                                            <span id="cashreceipt"></span>
                                            <br>
                                            <span id="changereceipt"></span>
                                        </td>
                                    </tr>
                                    
                                </tfoot>
                    


                    </table>
                </div>

                <div class="col">
                    <div class="row mt-2 p-2">
                        <div class="col-4">
                            <h3 class="text-center card-title text-uppercase text-danger mb-0">
                               {{$salesinvoice_id ?? ''}}
                            </h3>
                        </div>
                        <div class="col-8">
                            <small>Recieved the above goods in good order and condition</small>      
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row mt-2 p-2 ">
                        <div class="col-6">
                            <small>Dealer Of:</small>     
                        </div>
                        <div class="col-6">
                            <small>By:___________________</small>      
                        </div>
                        <div class="col-12">
                            <small>Coke Products/San Miguel Beer Products And Rice</small>     
                        </div>
                    </div>
                </div>


<script>
    
    $(function () {

        let formatNumber = Intl.NumberFormat('en-US', {
            style: "currency",
            currency: "PHP",
        });

        var cash = $('#cash').val();
        var change = $('#change').val();

        $('#cashreceipt').text(formatNumber.format(cash));
        $('#changereceipt').text('₱ ' + change);
    });
</script>


                
                
   
