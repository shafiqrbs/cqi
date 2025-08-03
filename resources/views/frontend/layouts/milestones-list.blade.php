
@foreach ($milestones as $index => $item)
    <div class="p-3 text-start border rounded shadow-sm mb-2 bg-light border-start border-3
border-{{ $colorClasses[$index % count($colorClasses)] }}">
        <small class="text-muted d-block">
            {{ $item->name }}
        </small>
    </div>
@endforeach