<?php
$pageTitle = "Netflix Service Info"; // Set page title
include 'templates/header.php';
?>

<div class="container mt-5 text-light">
    <h1 class="mb-4 text-danger">About Netflix</h1>

    <section class="mb-5">
        <h2><i class="fas fa-info-circle me-2"></i>Description</h2>
        <p>Netflix is a streaming service that offers a wide variety of award-winning TV shows, movies, anime, documentaries, and more on thousands of internet-connected devices.</p>
        <p>You can watch as much as you want, whenever you want without a single commercial – all for one low monthly price. There's always something new to discover and new TV shows and movies are added every week!</p>
         <div class="text-center my-4">
            <img src="https://about.netflix.com/images/meta/netflix-symbol-black.png" alt="Netflix Logo" style="height: 50px; background-color: #fff; padding: 5px; border-radius: 5px;">
         </div>
    </section>

    <section class="mb-5">
        <h2><i class="fas fa-dollar-sign me-2"></i>Subscription Plans & Pricing</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-dark border-secondary h-100">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Standard with ads</h5>
                        <p class="card-text">Great video quality in Full HD (1080p). Watch on 2 supported devices at a time. Contains ads.</p>
                        <p class="card-text fw-bold">Price: $6.99 / month</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                 <div class="card bg-dark border-secondary h-100">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Standard</h5>
                         <p class="card-text">Great video quality in Full HD (1080p). Watch on 2 supported devices at a time. Ad-free.</p>
                        <p class="card-text fw-bold">Price: $15.49 / month</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-dark border-secondary h-100">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Premium</h5>
                        <p class="card-text">Our best video quality in Ultra HD (4K) and HDR. Watch on 4 supported devices at a time. Ad-free. Spatial audio available.</p>
                        <p class="card-text fw-bold">Price: $22.99 / month</p>
                    </div>
                </div>
            </div>
        </div>
         <small class="text-muted">Note: Prices and plan features may vary by region and are subject to change. Visit the official Netflix website for current details.</small>
    </section>

    <section class="mb-5">
        <h2><i class="fas fa-laptop-house me-2"></i>Platform Availability</h2>
         <p>Watch Netflix on your smartphone, tablet, Smart TV, laptop, or streaming device. Available on:</p>
         <div class="d-flex flex-wrap justify-content-center fs-4">
             <span class="badge bg-secondary m-2 p-2"><i class="fas fa-mobile-alt me-1"></i> iOS & Android</span>
             <span class="badge bg-secondary m-2 p-2"><i class="fas fa-tv me-1"></i> Smart TVs</span>
             <span class="badge bg-secondary m-2 p-2"><i class="fas fa-laptop me-1"></i> Web Browsers</span>
             <span class="badge bg-secondary m-2 p-2"><i class="fas fa-gamepad me-1"></i> Game Consoles</span>
             <span class="badge bg-secondary m-2 p-2"><i class="fas fa-plug me-1"></i> Streaming Devices (Apple TV, Chromecast, etc.)</span>
         </div>
    </section>

     <section class="mb-5">
        <h2><i class="fas fa-play-circle me-2"></i>Promotional Video</h2>
         <div class="ratio ratio-16x9">
             <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             <!-- Replace with a real Netflix promo video URL -->
        </div>
    </section>

</div>

<?php include 'templates/footer.php'; ?>