{{-- resources/views/teacher/request.blade.php --}}
<form method="POST" action="{{ route('teacher.requests.store') }}">
@csrf

{{-- Subjects --}}
<fieldset>
    <legend>Subjects I want to teach</legend>
    @foreach($subjects as $subject)
        <label>
            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}">
            {{ $subject->name }}
        </label>
    @endforeach
    @error('subjects') <p class="error">{{ $message }}</p> @enderror
</fieldset>

{{-- Availability --}}
<fieldset>
    <legend>Availability — select min 3, max 6 days</legend>

    @php
        $days = ['sun'=>'Sunday','mon'=>'Monday','tue'=>'Tuesday',
                 'wed'=>'Wednesday','thu'=>'Thursday','fri'=>'Friday'];
    @endphp

    @foreach($days as $key => $label)
    <div class="day-row">

        <label>
            <input type="checkbox"
                   name="day_check[]"
                   value="{{ $key }}"
                   onchange="toggleDay('{{ $key }}', this.checked)">
            {{ $label }}
        </label>

        {{-- hidden until checkbox ticked --}}
        <div id="day_{{ $key }}" style="display:none; margin-left:1rem;">

            {{-- hidden day value --}}
            <input type="hidden" name="days[{{ $loop->index }}][day]" value="{{ $key }}">

            {{-- period picker: A / B / Both --}}
            <label>Period:</label>
            <label>
                <input type="radio" name="days[{{ $loop->index }}][period]" value="A">
                A &nbsp;(08:00 – 12:00)
            </label>
            <label>
                <input type="radio" name="days[{{ $loop->index }}][period]" value="B">
                B &nbsp;(12:00 – 16:00)
            </label>
            <label>
                <input type="radio" name="days[{{ $loop->index }}][period]" value="both" checked>
                Both (08:00 – 16:00)
            </label>

        </div>
    </div>
    @endforeach

    @error('days') <p class="error">{{ $message }}</p> @enderror
</fieldset>

{{-- Notes --}}
<div>
    <label>Notes (optional)</label>
    <textarea name="notes" rows="3">{{ old('notes') }}</textarea>
</div>

<button type="submit">Submit Request</button>

</form>

<script>
function toggleDay(day, checked) {
    document.getElementById('day_' + day).style.display = checked ? 'block' : 'none';
}
</script>
