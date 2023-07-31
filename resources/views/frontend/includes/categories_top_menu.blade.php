@foreach($categories as $category)
    @if(count($category->children) > 0)
        <li class="has-child">
            <a class="menu-parent load-transition" href="{{ route('category', ['slug' => $category->slug]) }}">{{ $category->name }} <span class="arrow-right"><i class="ti-angle-right"></i></span></a>
            <ul class="sub-ul-menu sub-ul-menu-child">
                <div class="row">
                    @include('frontend.includes.categories_top_menu',['categories' => $category->children])
                </div>
            </ul>
        </li>
    @else
        <li class="col-md-4">
            <a class="categoris_top load-transition" 
                href="{{ route('category', ['slug' => $category->slug]) }}">
                {{ $category->name }}
            </a>
        </li>
    @endif
@endforeach
