@props([
    "title" => "",
    "message" => "",
    "icon" => ""
])
<div class="feature-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div {{ $attributes->merge(["class" => "icon " . $icon]) }}></div>
								<strong>{{ $title }}</strong>
								<div class="text">{{ $message }}</div>
							</div>
						</div>
					</div>