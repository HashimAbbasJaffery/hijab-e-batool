@props(
    [
        "name" => "",
        "quantity" => 0
    ]
)
<div class="product-block-four col-lg-3 col-md-6 col-sm-6">
								<div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
									<div class="content">
										<h6><a href="shop-detail.html">{{ $name }}</a></h6>
										<div class="total-products">({{ $quantity }} Product)</div>
									</div>
								</div>
							</div>