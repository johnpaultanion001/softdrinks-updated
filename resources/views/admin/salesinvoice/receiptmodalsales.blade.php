<div id="receiptreportsales" class="d-print-inline-flex receiptreport p4 bg-white mt-2" style="border-radius: 5px;">
                
                <div class="col">
                    <h4 class="text-center card-title text-uppercase text-dark mb-0">{{ trans('panel.site_title') }}</h4>
                    <h5 class="text-center card-title text-muted mb-0">J.P Extension Libis Binangonan , Rizal <br>
                    Fernando L. Arada - Prop. <br>
                    Tel. No. 986-2433 Cel No. 0923-6738-296 </h5>
                    <br>
                    <div class="col-md-12">
                        <div class="col text-left"><h6 class="card-title text-uppercase text-danger mb-0">{{ $salesInvoices->doc_no ?? '' }} </h6></div>
                        <div class="col text-right"><h6 class="card-title text-uppercase text-muted mb-0">Date: {{ $salesInvoices->created_at->format('F d,Y h:i A') ?? '' }} </h6></div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <small class="text-muted mt-3 ml-1">Sold To:</small><br>
                            <small id="sold_to_receipt">{{$salesInvoices->customer->customer_name ?? ''}}</small>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted mt-3 ml-1">Assign Deliver:</small><br>
                                <small id="assign_to_receipt">{{$salesInvoices->deliver->title ?? ''}}</small>
                        </div>
                        <div class="col-sm-12">
                            <small class="text-muted mt-3 ml-1 address">Area:</small> <br>
                            <small id="area_receipt">{{$salesInvoices->customer->area ?? ''}}</small>
                        </div>
                    </div>
                </div>
                <div class="receipt-body mt--3 p-2" id="receipt-body-sales">
                    <?php 
                        $subtotal     = $salesInvoices->sales->sum('total_amount_receipt') + $salesInvoices->pallets->sum('amount');

                        $total_cost   = $salesInvoices->sales->sum('total') + $salesInvoices->pallets->sum('amount') + $salesInvoices->deposits->sum('amount');
                        $total_return = $salesInvoices->returns->sum('amount') + $salesInvoices->pallets_returns->sum('amount');

                        $payment = $total_cost - $total_return;
                        $change  =  $salesInvoices->cash  - $payment;
            
                        if ($salesInvoices->isReceivable == 1){    
                            $change = $change - $salesInvoices->prev_bal;
                                if($change < 0 ){
                                    $change = 0;
                                }
                        }

                    ?>
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
                                    @foreach($salesInvoices->receipt_product as $key => $receipt)
                                        <tr>
                                            <td></td>
                                            <td>{{$receipt->purchase_qty ?? ''}}</td>
                                            <td>{{$receipt->product->category->name ?? ''}}</td>
                                            <td>{{$receipt->product->description ?? ''}}</td>
                                            <td>₱ {{ number_format($receipt->product->price ?? '' , 2, '.', ',') }}</td>
                                            <td>₱  {{ number_format($receipt->total_amount_receipt ?? '' , 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($salesInvoices->pallets as $pallet)
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
                                                ₱ ( {{ number_format($salesInvoices->receipt_product->sum->discounted ?? '' , 2, '.', ',') }} )
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
                                    @foreach($salesInvoices->receipt_return as $return)
                                        <tr>
                                            <td></td>
                                            <td>{{$return->return_qty ?? ''}}</td>
                                            <td></td>
                                            <td>{{$return->product->description ?? 'NO BRAND'}}</td>
                                            <td>₱ {{ number_format($return->unit_price ?? '' , 2, '.', ',') }}</td>
                                            <td>₱ {{ number_format($return->amount ?? '' , 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($salesInvoices->pallets_returns as $pallet)
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
                                        <td>
                                            Prev Bal.: 
                                            <br>
                                            New Bal.:
                                        </td>
                                        <td>
                                            ₱ {{ number_format($salesInvoices->prev_bal ?? '' , 2, '.', ',') }}
                                            <br>
                                            ₱ {{ number_format($salesInvoices->new_bal ?? '' , 2, '.', ',') }}
                                           
                                        </td>
                                        <td>
                                            Total Return Amt: 
                                                <br>
                                            Total Deposit Amt:
                                        </td>
                                        <td> 
                                                ₱ ( {{ number_format($total_return ?? '' , 2, '.', ',') }} ) 
                                                    <br>
                                                ₱ {{ number_format($salesInvoices->deposits->sum('amount') ?? '' , 2, '.', ',') }}
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
                                                ₱ {{ number_format($payment ?? '' , 2, '.', ',') }}
                                            <br>
                                                ₱ {{ number_format($salesInvoices->cash ?? '' , 2, '.', ',') }}
                                            <br>
                                                ₱ {{ number_format($change ?? '' , 2, '.', ',') }}

                                        </td>
                                    </tr>
                                    
                                </tfoot>
                    


                    </table>
                </div>
                <div class="col">
                    <div class="row mt-2 p-2">
                        <div class="col-4">
                            <h3 class="text-center card-title text-uppercase text-danger mb-0">
                               {{$salesInvoices->salesinvoice_id ?? ''}}
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

                
                
            
    </div>
