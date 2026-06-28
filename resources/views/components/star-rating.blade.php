@if ($rating)
    @for ($i = 1; $i <= 5; $i++)
        @if ($i<=$rating)   
            <span>★</span>
        @else
            <span>☆</span>
        @endif
    @endfor
@else
    <p>Chưa có đánh giá</p>
@endif