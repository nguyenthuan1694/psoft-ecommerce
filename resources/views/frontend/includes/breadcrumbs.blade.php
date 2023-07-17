<div class="ps-breadcrumb">
    <div class="bg-transparent">
        <div class="container">
            @if (count($breadcrumbs))
                <ul class="breadcrumb">
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if ($breadcrumb->url && !$loop->last)
                            <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                        @else
                            <li>{{ $breadcrumb->title }}</li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>