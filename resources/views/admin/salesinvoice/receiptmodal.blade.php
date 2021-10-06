

                <div class="receipt-body mt--3 p-2" id="receipt-body">
                    <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Articles</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @forelse($receipts as $key => $receipt)
                                        <tr>
                                            <td>{{$receipt->purchase_qty}}</td>
                                            <td>{{$receipt->inventory->category->name}}</td>
                                            <td>{{$receipt->inventory->short_description}}</td>
                                            <td>₱ {{ number_format($receipt->inventory->price ?? '' , 2, '.', ',') }}</td>
                                            <td>₱ {{ number_format($receipt->total_amount_receipt ?? '' , 2, '.', ',') }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                            <td></td>
                                            <td></td>
                                            <td>No Data Availalbe</td>
                                            <td></td>
                                            <td></td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            Sub Total:
                                            <br>
                                            Return:
                                            <br>
                                            Discounted:
                                            
                                        </td>
                                        <td> 
                                            ₱ {{ number_format($receipts->sum->total_amount_receipt ?? '' , 2, '.', ',') }}
                                            <br>
                                            ₱ ( {{ number_format($totalsalesreturn ?? '' , 2, '.', ',') }} )
                                            <br>
                                            ₱ ( {{ number_format($receipts->sum->discounted ?? '' , 2, '.', ',') }} )
                                        </td>
                                    </tr>
                                    <tr>
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
                                            ₱ {{ number_format($total ?? '' , 2, '.', ',') }}
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
                               {{$salesinvoice_id}}
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
        var change = $('#change').text();

        $('#cashreceipt').text(formatNumber.format(cash));
        $('#changereceipt').text('₱ ' + change);
    });
</script>


                
                
   
