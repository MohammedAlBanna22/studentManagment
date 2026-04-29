@if($requests->isEmpty())
<tr>
    <td colspan="7" style="text-align:center;">No requests found</td>
</tr>
@else
@foreach($requests as $req)
<tr id="row-{{ $req->id }}" data-status="{{ $req->status }}">

    {{-- # --}}
    <td style="color:var(--muted);font-size:.8rem;">
        {{ $req->id }}
    </td>

    {{-- Teacher --}}
    <td>
        <div style="font-weight:700;">
            {{ $req->teacher->user->name }}
        </div>
        <div style="font-size:.75rem;color:var(--muted);">
            {{ $req->teacher->user->email }}
        </div>
    </td>

    {{-- Subjects --}}
    <td>
        @foreach($req->subjects as $s)
            <span class="tag">{{ $s->name }}</span>
        @endforeach
    </td>

    {{-- Availability --}}
    <td>
        <div class="avail-mini">
            @foreach($req->availability as $av)
            <span>
                <span class="d" style="background:
                    {{ $av->period==='A'?'#6c63ff':($av->period==='B'?'#43e97b':'#f59e0b') }}">
                </span>
                {{ strtoupper($av->day) }}
                @if($av->period==='A') A
                @elseif($av->period==='B') B
                @else A+B
                @endif
            </span>
            @endforeach
        </div>
    </td>

    {{-- Status --}}
    <td>
        <span class="badge badge-{{ $req->status }}" id="badge-{{ $req->id }}">
            <span class="badge-dot"></span>
            {{ ucfirst($req->status) }}
        </span>
    </td>

    {{-- Submitted --}}
    <td style="color:var(--muted);font-size:.8rem;">
        {{ $req->created_at->diffForHumans() }}
    </td>

    {{-- Actions --}}
    <td>
    @if($req->status === 'pending')
        <div class="actions-cell">

            <a href="{{ route('admin.schedule.assign', $req) }}"
               class="icon-btn assign"
               data-tip="Assign Schedule">
                ✔
            </a>

            <button class="icon-btn delete"
                    onclick="confirmDelete({{ $req->id }})">
                🗑
            </button>

        </div>
    @endif
</td>

</tr>
@endforeach
@endif
