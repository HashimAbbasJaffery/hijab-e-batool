@props([
    "quantity",
    "name",
    "icon",
    "color",
    "href"
])

<div class="col-lg-3 col-xs-6">
    <div class="small-box {{ $color }}">
    <div class="inner">
    <h3>{{ $quantity }}</h3>
    <p>{{ $name }}</p>
    </div>
    <div class="icon">
    <i class="{{ $icon }}"></i>
    </div>
    <a href="{{ $href }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>