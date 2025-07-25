

@extends('frontend.layouts.app')
@section('content')
    <div class="gallery-section">
        <div class="gallery-header">
            <h2 class="gallery-title">Our {{$type=='gallery'?'Photo':'Resource'}} Collection</h2>
            <p class="gallery-subtitle">Explore memorable moments captured through our lens. Click on any image to view in full size.</p>
        </div>

        <div id="gallery" class="gallery-grid">
            @if($galleries && count($galleries) > 0)
                @foreach($galleries as $gallery)
                    <div class="gallery-item">
                        <a href="{{route('swapno-gallery-details', $gallery->id)}}">
                            <div class="gallery-icon">
                                @if($type=='gallery')
                                <i class="fas fa-camera-retro"></i>
                                @else
                                    <i class="fas fa-file-alt"></i>
                                @endif
                            </div>
                            <div class="gallery-name">{{ $gallery->name }}</div>
                            <div class="gallery-subtitle">Click to explore</div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="no-galleries">
                        <i class="fas fa-image"></i>
                        <h3>No Galleries Found</h3>
                        <p>Check back later for new photo collections</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('CustomStyle')
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

        /* Gallery Section */

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
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }


        .section-title h2 {
            color: #333;
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .section-title p {
            color: #666;
            font-size: 1.2rem;
            font-weight: 300;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .gallery-item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .gallery-item:hover::before {
            opacity: 1;
        }

        .gallery-item:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .gallery-item a {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100%;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .gallery-icon {
            font-size: 3.5rem;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-icon {
            transform: scale(1.1);
            color: #fff;
        }

        .gallery-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: #ffffff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-name {
            color: #fff;
            transform: translateY(-2px);
        }

        .gallery-item:hover .gallery-subtitle {
            opacity: 1;
        }

        /* Floating animation */
        .gallery-item {
            animation: float 6s ease-in-out infinite;
        }

        .gallery-item:nth-child(even) {
            animation-delay: -3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .gallery-item:hover {
            animation-play-state: paused;
        }

        /* No galleries message */
        .no-galleries {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .no-galleries i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.6;
            color: #999;
        }

        .no-galleries h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #333;
        }

        .no-galleries p {
            font-size: 1.1rem;
            opacity: 0.8;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .title-text {
                font-size: 2rem;
            }

            .section-title h2 {
                font-size: 2.2rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 10px;
            }


            .gallery-item {
                min-height: 200px;
                padding: 20px;
            }

            .gallery-icon {
                font-size: 2.5rem;
                margin-bottom: 15px;
            }

            .gallery-name {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .header-section {
                padding: 20px;
                margin-bottom: 20px;
            }

            .title-text {
                font-size: 1.8rem;
            }

            .logo-container img {
                width: 60px !important;
            }
        }

        /* Loading animation */
        .gallery-item {
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }

        .gallery-item:nth-child(1) { animation-delay: 0.1s; }
        .gallery-item:nth-child(2) { animation-delay: 0.2s; }
        .gallery-item:nth-child(3) { animation-delay: 0.3s; }
        .gallery-item:nth-child(4) { animation-delay: 0.4s; }
        .gallery-item:nth-child(5) { animation-delay: 0.5s; }
        .gallery-item:nth-child(6) { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
@push('CustomJs')

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
@endpush
