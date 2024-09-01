@extends('layouts.app')

@section('content')
    <div class="hero-section"
         style="background-image: url({{asset('assets/images/hero.png')}}); background-size: cover; background-position: center; padding: 100px 0;">
        <div class="container text-center text-white">
            <h1 class="display-4 font-weight-bold">Welcome to Our Loan Request App</h1>
            <p class="lead">Fast, Easy, and Secure Loan Applications</p>
            <a href="{{route('request')}}" class="btn btn-outline-light btn-lg mt-3">Apply Now</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-5">Why Choose Us?</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <i class="fas fa-bolt fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Fast Approval</h5>
                        <p class="card-text">Get your loan approved in just a few hours with our efficient system.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <i class="fas fa-lock fa-3x text-black mb-3"></i>
                        <h5 class="card-title">Secure Process</h5>
                        <p class="card-text">Your data and transactions are fully secure and encrypted.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <i class="fas fa-handshake fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Reliable Service</h5>
                        <p class="card-text">Trusted by thousands of customers for our reliable loan services.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section with Carousel -->
    <div class="container mt-5">
        <h2 class="text-center mb-5">What Our Customers Say</h2>
        <div id="testimonialCarousel" class="carousel slide shadow-lg" data-bs-ride="carousel">
            <div class="carousel-inner text-center">
                <div class="carousel-item active">
                    <div class="testimonial bg-light p-4 shadow-sm rounded d-flex flex-column align-items-center">
                        <img src="{{asset('assets/images/user1.png')}}" alt="Customer Image" class="rounded-circle mb-3"
                             style="width: 80px; height: 80px;">
                        <div>
                            <p class="mb-0">"The loan application process was efficient and hassle-free. I received
                                approval within a single day, exceeding my expectations!"</p>
                            <p class="mt-2"><strong>- John Doe</strong>, Business Owner</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial bg-light p-4 shadow-sm rounded d-flex flex-column align-items-center">
                        <img src="{{asset('assets/images/user3.png')}}" alt="Customer Image" class="rounded-circle mb-3"
                             style="width: 80px; height: 80px;">
                        <div>
                            <p class="mb-0">"I highly recommend this platform. It's not only secure but also offers
                                exceptional customer service. A truly professional experience!"</p>
                            <p class="mt-2"><strong>- Jane Smith</strong>, Financial Advisor</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial bg-light p-4 shadow-sm rounded d-flex flex-column align-items-center">
                        <img src="{{asset('assets/images/user2.png')}}" alt="Customer Image" class="rounded-circle mb-3"
                             style="width: 80px; height: 80px;">
                        <div>
                            <p class="mb-0">"The entire process was seamless and transparent. I appreciated the clear
                                communication and prompt service at every step."</p>
                            <p class="mt-2"><strong>- Alex Johnson</strong>, Marketing Executive</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial bg-light p-4 shadow-sm rounded d-flex flex-column align-items-center">
                        <img src="{{asset('assets/images/user1.png')}}" alt="Customer Image" class="rounded-circle mb-3"
                             style="width: 80px; height: 80px;">
                        <div>
                            <p class="mb-0">"Excellent service! The team was very supportive and made sure I understood
                                all my options before proceeding."</p>
                            <p class="mt-2"><strong>- Emily Clark</strong>, Entrepreneur</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial bg-light p-4 shadow-sm rounded d-flex flex-column align-items-center">
                        <img src="{{asset('assets/images/user3.png')}}" alt="Customer Image" class="rounded-circle mb-3"
                             style="width: 80px; height: 80px;">
                        <div>
                            <p class="mb-0">"I was impressed by the professionalism and efficiency. The application was
                                straightforward, and I received my funds quickly."</p>
                            <p class="mt-2"><strong>- Michael Lee</strong>, Software Developer</p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <div class="shadow-lg p-5 m-3 cta-section text-dark text-center py-5 mt-5 border-0">
        <h5 class="display-6 mb-4">Take the Next Step Towards Financial Freedom</h5>
        <p class="lead mb-4 p-4">Achieve your financial goals with ease! Our streamlined loan application process is
            designed to offer you quick and efficient access to the funds you need. Whether you’re planning to invest in
            your future, manage unexpected expenses, or consolidate debt, we provide competitive rates and personalized
            support every step of the way.</p>
        <p class="mb-4">We are committed to transparency and customer satisfaction. Rest assured, your application will
            be handled with the utmost care and professionalism. Don’t let financial barriers hold you back—empower your
            future with confidence today.</p>
        <a href="{{route('request')}}" class="btn btn-outline-dark btn-lg px-4 py-2">Apply Now</a>
    </div>

@endsection
