
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
					<div class="feature-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div class="icon flaticon-padlock"></div>
								<strong>Payment Secure</strong>
								<div class="text">Got 100% Payment Safe</div>
							</div>
						</div>
					</div>
					
					<!-- Feature Block -->
					<div class="feature-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div class="icon flaticon-headphones-1"></div>
								<strong>Support 24/7</strong>
								<div class="text">Top quialty 24/7 Support</div>
							</div>
						</div>
					</div>
					
					<!-- Feature Block -->
					<div class="feature-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div class="icon flaticon-wallet"></div>
								<strong>100% Money Back</strong>
								<div class="text">Cutomers Money Backs</div>
							</div>
						</div>
					</div>
					
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
				
				
				<x-front.product name="hashim"/>
				<x-front.product name="tanzeela"/>
				<x-front.product name="taskeen"/>
				<x-front.product name="Jawed"/>
				<x-front.product name="Sadia"/>
				
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
					<div class="slide">
						<div class="row clearfix">
						
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>	
							
						</div>
					</div>
					
					<!-- Slide -->
					<div class="slide">
						<div class="row clearfix">
						
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							<x-front.category name="hashim" quantity="1"/>
							
						</div>
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

					
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				<x-front.product name="hashim" class="mix sports bestseller col-lg-3 col-md-6 col-sm-12"/>
				
					
					
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


</x-layout>
	
	
	