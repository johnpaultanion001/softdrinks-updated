<div class="row container">
    <div class="col-xl-12 m-2">
        <h2 class="text-uppercase text-muted">Profit Graph</h2>
        {!! $chart1->renderHtml() !!}
        {!! $chart1->renderJs() !!}
    </div>
    <div class="col-xl-12 m-2">
        <h2 class="text-uppercase text-muted">Product Sold Graph</h2>
        {!! $chart2->renderHtml() !!}
        {!! $chart2->renderJs() !!}
    </div>
    <div class="col-xl-12 m-2">
        <h2 class="text-uppercase text-muted">UCS Graph</h2>
        {!! $chart3->renderHtml() !!}
        {!! $chart3->renderJs() !!}
    </div>

</div>



 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
