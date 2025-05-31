<nav class="text-sm mb-4 text-gray-600">
    <ol class="list-reset flex">
        <li>
            <a href="{{ route('dashboard') }}" class="hover:underline text-blue-600">Dashboard</a>
        </li>
        @isset($breadcrumbs)
            @foreach ($breadcrumbs as $label => $url)
                <li>
                    <span class="mx-2">/</span>
                </li>
                <li>
                    @if ($url)
                        <a href="{{ $url }}" class="hover:underline text-blue-600">{{ $label }}</a>
                    @else
                        <span class="text-gray-800">{{ $label }}</span>
                    @endif
                </li>
            @endforeach
        @endisset
    </ol>
</nav>
