
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWAPNO Photo Gallery</title>
    <link rel="icon" type="image/png" href="{{asset('assets/logo.jpeg')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add lightbox2 CSS for the gallery -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d10000;
            --secondary-color: #007bff;
            --accent-color: #ffc107;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }

        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header Styles */
        .header-container {
            background: linear-gradient(135deg, #ffffff 0%, #f1f8ff 100%);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            border-bottom: 5px solid var(--primary-color);
        }

        .title-text {
            font-weight: 800;
            color: var(--primary-color);
            text-align: center;
            font-size: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            letter-spacing: -0.5px;
        }

        .title-text i {
            color: #d10000;
        }

        /* Gallery Styles */
        .gallery-section {
            margin-top: 30px;
            padding: 20px 0;
        }

        .gallery-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .gallery-title {
            font-size: 2.2rem;
            color: var(--dark-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .gallery-title:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .gallery-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 15px;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: white;
            position: relative;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }

        .gallery-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-caption {
            padding: 15px;
            background: white;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .gallery-caption h5 {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 1.05rem;
        }

        .gallery-caption p {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .view-more {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .view-more {
            opacity: 1;
        }

        /* Lightbox customizations */
        .lb-data .lb-caption {
            font-size: 1rem;
            line-height: 1.5;
            padding: 15px 0;
        }

        .lb-nav a.lb-prev,
        .lb-nav a.lb-next {
            opacity: 0.9;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 15px;
            }

            .title-text {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .gallery-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
<div class="container py-4">
    <!-- Header Section -->
    <div class="header-container">
        <div class="row align-items-center">
            <div class="col-md-2 text-center">
                <a href="{{route('home')}}">
                    <img width="50%" src="{{asset('assets/logo.jpeg')}}" alt="Swapno" class="img-fluid">
                </a>
            </div>
            <div class="col-md-8">
                <h4 class="title-text">
                    <i class="fas fa-images me-2"></i>
                    Swapno Gallery
                </h4>
            </div>
            <div class="col-md-2 text-end">
                <img width="50%" src="{{asset('assets/logo-gain-health.svg')}}" alt="Gain Health" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="gallery-section">
        <div class="gallery-header">
            <h2 class="gallery-title">Our Photo Collection</h2>
            <p class="gallery-subtitle">Explore memorable moments captured through our lens. Click on any image to view in full size.</p>
        </div>

        <div id="gallery" class="gallery-grid">
            @if($galleries->photoGalleryImages)
                @foreach($galleries->photoGalleryImages as $image)
                    <div class="gallery-item">
                        <div class="gallery-image-container">
                            <a href="{{asset("photo_gallery/$image->gallery_image")}}" data-lightbox="gallery" data-title="<h5>{{$image->caption}}</h5>">
                                <img src="{{asset("photo_gallery/$image->gallery_image")}}" alt="{{$image->caption}}">
                            </a>
                            <div class="view-more">
                                <i class="fas fa-expand"></i>
                            </div>
                        </div>
                        <div class="gallery-caption">
                            <h5>{{ Str::limit($image->caption, 40) }}</h5>
{{--                            <p>{{ Str::limit($image->caption, 80) }}</p>--}}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <i class="fas fa-camera fa-3x mb-3" style="color: #ddd;"></i>
                    <h4>No photos available yet</h4>
                    <p>Check back later for our gallery updates</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add jQuery (required for lightbox) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Add lightbox2 JS for the gallery slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    // Lightbox customization
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': true,
        'positionFromTop': 100,
        'disableScrolling': true
    });

    // Add animation to gallery items when they come into view
    document.addEventListener('DOMContentLoaded', function() {
        const galleryItems = document.querySelectorAll('.gallery-item');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        galleryItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.transition = `all 0.5s ease ${index * 0.1}s`;
            observer.observe(item);
        });
    });
</script>
</body>
</html>