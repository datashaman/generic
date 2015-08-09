@foreach ($menu['items'] as $item)
<li class="@unless(empty($item['class'])){{ $item['class'] }}@endunless @unless(empty($item['items'])) dropdown @endunless" @unless(empty($item['id']))id="{{ $item['id'] }}"@endunless>
@unless(empty($item['route']))<a href="{{ call_user_func_array('route', $item['route']) }}">@endunless
@unless(empty($item['href']))<a href="{{ $item['href'] }}">@endunless
@unless(empty($item['items']))<a href="#" class="dropdown-toggle" data-toggle="dropdown">@endunless
@unless(empty($item['title'])){{ $item['title'] }}@endunless
@unless(empty($item['items']))<b class="caret"></b>@endunless
@unless(empty($item['route']) && empty($item['href']) && empty($item['items']))</a>@endunless
@unless(empty($item['items']))<ul class="dropdown-menu">
@include('_menu', [ 'menu' => $item ])
</ul>@endunless
</li>
@endforeach
