<select class="form-control" name="district_id" id="district_id" attr_url="{{url('combo-info')}}">
    <option value="">Select District</option>
    @forelse($districts as $district)
        <option value="{{ $district->id }}">{!! $district->name ?? '' !!}</option>
    @empty
    @endforelse            
</select>