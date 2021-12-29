<select name="location_from" id="location_from" class="form-control select2">
    @foreach ($product_location as $location)
        <option value="{{$location->location_id}}"> {{$location->location->location_name}} ({{$location->stock}})</option>
    @endforeach
</select>
<span class="invalid-feedback" role="alert">
    <strong id="error-location_from"></strong>
</span>  

<script>
    $(function () {
        $('.select2').select2();
    });
</script>