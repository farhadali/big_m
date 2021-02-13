
<select class="form-control" name="upazila_id" id="upazila_id">
    <option value="">Select Upazila</option>
    @forelse($upazilas as $upazila)
        <option value="{{ $upazila->id }}">{!! $upazila->name ?? '' !!}</option>
    @empty
    @endforelse
    
</select>