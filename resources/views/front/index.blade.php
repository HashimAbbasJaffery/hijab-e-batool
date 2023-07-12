
<x-layout >
	<!-- Sidebar Cart Item -->
	<div class="xs-sidebar-group info-group">
		<div class="xs-overlay xs-bg-black"></div>
		<div class="xs-sidebar-widget">
			<div class="sidebar-widget-container">
				<div class="widget-heading">
					<a href="#" class="close-side-widget flaticon-multiply"></a>
				</div>
				<div class="sidebar-textwidget">
					
					<!-- Sidebar Info Content -->
					<div class="sidebar-info-contents">
						<div class="content-inner">
							<div class="logo">
								<a href="index.html"><img src="../front/images/logo.png" alt="" title=""></a>
							</div>
							<div class="content-box">
								
								<h6>Services</h6>
								<ul class="sidebar-services-list">
									<li><a href="#">Laptops & Computers</a></li>
									<li><a href="#">Cameras & Photography</a></li>
									<li><a href="#">Smart Phones & Tablets</a></li>
									<li><a href="#">Video Games & Consoles</a></li>
									<li><a href="#">TV & Audio</a></li>
									<li><a href="#">LED Table</a></li>
								</ul>
								
								<h6>Contact info</h6>
								<!-- List Style One -->
								<ul class="list-style-one">
									<li>
										<span class="icon flaticon-maps-and-flags"></span>
										<strong>Our office</strong>
										A-1, Envanto Headquarters, <br> Melbourne, Australia.
									</li>
									<li>
										<span class="icon flaticon-call-1"></span>
										<strong>Phone</strong>
										<a href="tel:+00-999-999-9999">+(00) 999 999 9999</a><br>
										<a href="tel:+000-000-0000">000 000 0000</a>
									</li>
									<li>
										<span class="icon flaticon-mail"></span>
										<strong>Email</strong>
										<a href="mailto:contact@bloxic.com">contact@Bloxic.com</a>
									</li>
								</ul>
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- Featured Section -->
	<section class="featured-section">
		<div class="vector-layer" style="background-image: url(images/icons/vector-1.png)"></div>
		<div class="vector-layer-two" style="background-image: url(images/icons/feature.png)"></div>
		<div class="auto-container">
			<div class="inner-container">
				<div class="row clearfix">
					<!-- Feature Block -->
					<x-front.feature title="Payment Secure" message="Got 100% Payment Safe" icon="flaticon-padlock"/>
					<x-front.feature title="Support 24/7" message="Top quality 24/7 Support" icon="flaticon-headphones-1"/>
					<x-front.feature title="100% Money Back" message="Cutomers Money Backs" icon="flaticon-wallet"/>
					
				</div>
			</div>
		</div>
	</section>
	<!-- End Featured Section -->
	
	<!-- Products Section -->
	<section class="products-section">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title">
				<h4><span>Popular</span> Products</h4>
			</div>
			<div class="four-item-carousel owl-carousel owl-theme">
				
				<!-- Shop Item -->
				
					@foreach($products as $product)
						@if($loop->index < 8)
							<x-front.product :product="$product"/>
						@endif
					@endforeach
				
			</div>
		</div>
	</section>
	<!-- End Products Section -->
	<!-- Sale Section -->
	{{-- <section class="sale-section">
		<div class="auto-container">
			<div class="row clearfix">
			
				<!-- Sale Block -->
				<div class="sale-block col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="inner-box">
						<div class="sale-box">
							SALE
							<span>30<i>% OFF</i></span>
						</div>
						<div class="image d-flex justify-content-between align-items-center">
							<img src="../front/images/resource/shop-1.jpg" alt="" />
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="off">Get 30% off</div>
									<h5><a href="shop-detail.html">Be together in the moment <br> with Barnix calling</a></h5>
									<a class="buy-now" href="shop-detail.html">buy now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Sale Block -->
				<div class="sale-block col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="inner-box">
						<div class="sale-box">
							SALE
							<span>30<i>% OFF</i></span>
						</div>
						<div class="image d-flex justify-content-between align-items-center">
							<img src="../front/images/resource/shop-2.jpg" alt="" />
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="off">Get 30% off</div>
									<h5><a href="shop-detail.html">Be together in the moment <br> with Barnix calling</a></h5>
									<a class="buy-now" href="shop-detail.html">buy now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section> --}}
	<!-- End Sale Section -->
	
	<!-- Products Section Two -->
	<section class="products-section-two">
		<div class="bottom-white-border"></div>
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<h4><span>Popular</span> Categories</h4>
			</div>
			<div class="inner-container">
				<div class="single-item-carousel owl-carousel owl-theme">
					
					<!-- Slide -->
					{{-- @dd($categoryCollection) --}}
					@foreach($categoryCollection as $categories)
						@if($loop->index < 8)
							<div class="slide">
								<div class="row clearfix">
									@foreach($categories as $category)
										<x-front.category :name="$category->name" :quantity="$category->products->count()"/>	
									@endforeach
									
								</div>
							</div>
						@else
							
							<!-- Slide -->
							<div class="slide">
								<div class="row clearfix">
								@foreach($categories as $category)
									<x-front.category :name="$category->name" :quantity="$category->products->count()"/>
								@endforeach
								
							</div>
						@endif
					@endforeach
						</div>
					
					
				</div>
				
			</div>
		</div>
	</section>
	<!-- End Products Section Two -->
	
	<!-- Counter Section -->
	<section class="counter-section">
		<div class="auto-container">
			<div class="inner-container d-flex justify-content-between align-items-center flex-wrap">
				
				<!-- Shipping Box -->
				<div class="shipping-box">
					<div class="inner-box">
						Trusted <span class="theme_color">Hijab</span>
						<div class="order">Shop</div>
					</div>
				</div>
				
				<!-- Arrow -->
				<div class="arrow">
					<img src="../front/images/icons/arrow.png" alt="" />
				</div>
				
				<!-- Counter Boxed -->
				<div class="counter-boxed">
					<div class="row clearfix">
					
						<!-- Counter Column -->
						<div class="counter-block col-lg-6 col-md-6 col-sm-6">
							<div class="inner-box d-flex align-items-center">
								<div class="counter"><span class="odometer" data-count="12"></span>k</div>
								<div class="counter-text">Total Orders</div>
							</div>
						</div>
						
						<!-- Counter Column -->
						<div class="counter-block col-lg-6 col-md-6 col-sm-6">
							<div class="inner-box d-flex align-items-center">
								<div class="counter"><span class="odometer" data-count="12"></span>k</div>
								<div class="counter-text">Total orders (today)</div>
							</div>
						</div>
						
					</div>
				</div>
				<!-- End Counter Boxed -->
				
			</div>
		</div>
	</section>
	<!-- End Counter Section -->
	
	<!-- Products Section Three -->
	<section class="products-section-three">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title">
				<h4><span>Our </span> products</h4>
			</div>
			
			<!-- MixitUp Galery -->
            <div class="mixitup-gallery">
                
                
                <div class="filter-list row clearfix">
					
					<!-- Shop Item -->
				
					{{-- mix sports bestseller col-lg-3 col-md-6 col-sm-12 --}}

					
				@foreach($shopProducts as $product)
					@if($loop->index < 12)
						<x-front.product classes="mix sports bestseller col-lg-3 col-md-6 col-sm-12" :product="$product"/>
					@else 
						@break
					@endif
				@endforeach
				
					
					
				</div>
				
				<!-- Button Box -->
				<div class="button-box text-center">
					<a href="shop.html" class="theme-btn btn-style-one">
						Show all <span class="icon flaticon-right-arrow"></span>
					</a>
				</div>
				
			</div>
		</div>
	</section>
	<!-- End Products Section Three -->

@push("front-scripts")
<script src="https://cdn.jsdelivr.net/npm/jquery.nice-number@2.1.0/src/jquery.nice-number.js"></script>

	<script>
		const parseId = id => id.split("-")[1];
		const buttonGetter = symbol => {
			return `<button style="border: none" class="btn btn-default bootstrap-touchspin-up" type="button">${symbol}<i class="glyphicon glyphicon-chevron-up"></i></button>`
		}
		const field = $('input[type="number"]');
		const adjustPrice = (currentInput, amount) => {
				const id = currentInput[0].id;
				const priceTagId = "price-tag-" + parseId(id);
				const priceTag = document.getElementById(priceTagId) 
				const overallPrice = amount * priceTag.dataset.price;
				const overallDiscountPrice = amount * priceTag.dataset.discount;
				const newPriceContent = `<span>$${overallDiscountPrice}.52</span> ${overallPrice} RS -/`;
				priceTag.innerHTML = newPriceContent;
		}
		const replaceContent = (id, content) => {
			$(id).html(content);
			const element = document.getElementById(id);
		}
		field.niceNumber({
			onIncrement: function($currentInput, amount) {
				adjustPrice($currentInput, amount);
			}, 
			onDecrement: function($currentInput, amount) {
				adjustPrice($currentInput, amount)
			},
			buttonDecrement: buttonGetter("-"),
			buttonIncrement: buttonGetter("+")
		});
	</script>
@endpush
</x-layout>
	
	
	