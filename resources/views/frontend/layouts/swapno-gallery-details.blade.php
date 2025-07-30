
@extends('frontend.layouts.app')

@section('content')
    <!-- Dynamic Hero Section -->
    <div class="hero-banner">
        <div class="hero-overlay"></div>
        <div class="hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="breadcrumb-nav">
                    <a href="{{ route('swapno-gallery', ['type' => $type]) }}" class="breadcrumb-link">
                        <i class="fas fa-arrow-left"></i> Back to {{ $type == 'gallery' ? 'Gallery' : 'Resources' }}
                    </a>
                </div>
                <div class="hero-icon">
                    @if($type=='gallery')
                        <i class="fas fa-images"></i>
                    @else
                        <i class="fas fa-folder-open"></i>
                    @endif
                </div>
                <h1 class="hero-title">{{ $galleries->name ?? 'Collection' }}</h1>
                <p class="hero-subtitle">
                    @if($type=='gallery')
                        Discover stunning moments captured through our lens. Click on any image to view in full size.
                    @else
                        Explore valuable resources and documents. Click to download or view files.
                    @endif
                </p>
                <div class="gallery-stats">
                    <div class="stat-card">
                        <span class="stat-number">{{ $galleries->photoGalleryImages ? count($galleries->photoGalleryImages) : 0 }}</span>
                        <span class="stat-label">{{ $type=='gallery' ? 'Photos' : 'Files' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Gallery Section -->
    <div class="gallery-showcase">
        <div class="container">
            @if($galleries->photoGalleryImages && count($galleries->photoGalleryImages) > 0)
                <!-- Filter Controls -->
                <div class="filter-controls">
                    <button class="filter-btn active" data-filter="all">
                        <i class="fas fa-th"></i> All Items
                    </button>
                    <button class="filter-btn" data-filter="images">
                        <i class="fas fa-image"></i> Images
                    </button>
                    <button class="filter-btn" data-filter="documents">
                        <i class="fas fa-file"></i> Documents
                    </button>
                </div>

                <!-- Masonry Gallery Grid -->
                <div class="masonry-grid" id="gallery-grid">
                    @foreach($galleries->photoGalleryImages as $index => $image)
                        @php
                            $file = "photo_gallery/$image->gallery_image";
                            $fileUrl = asset($file);
                            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                            $itemType = $isImage ? 'images' : 'documents';
                        @endphp

                        <div class="gallery-card {{ $itemType }}"
                             data-aos="fade-up"
                             data-aos-delay="{{ $index * 50 }}"
                             data-category="{{ $itemType }}">

                            <div class="card-container">
                                @if($isImage)
                                    <!-- Image Item -->
                                    <div class="image-wrapper">
                                        <a href="{{ $fileUrl }}"
                                           data-lightbox="gallery"
                                           data-title="{{ $image->caption }}"
                                           class="image-link">
                                            <img src="{{ $fileUrl }}"
                                                 alt="{{ $image->caption }}"
                                                 loading="lazy"
                                                 class="gallery-image">
                                            <div class="image-overlay">
                                                <div class="overlay-content">
                                                    <i class="fas fa-expand-alt"></i>
                                                    <span>View Full Size</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <!-- Document Item -->
                                    <div class="document-wrapper">
                                        <a href="{{ $fileUrl }}"
                                           target="_blank"
                                           class="document-link"
                                           title="{{ $image->caption }}">
                                            <div class="document-preview file-{{ $extension }}">
                                                <div class="file-icon">
                                                    <i class="
                                                        @if($extension === 'pdf') fas fa-file-pdf
                                                        @elseif($extension === 'csv') fas fa-file-csv
                                                        @elseif(in_array($extension, ['xlsx', 'xls'])) fas fa-file-excel
                                                        @elseif(in_array($extension, ['doc', 'docx'])) fas fa-file-word
                                                        @elseif(in_array($extension, ['ppt', 'pptx'])) fas fa-file-powerpoint
                                                        @elseif(in_array($extension, ['zip', 'rar'])) fas fa-file-archive
                                                        @else fas fa-file-alt
                                                        @endif
                                                    "></i>
                                                </div>
                                                <div class="file-info">
                                                    <span class="file-type">{{ strtoupper($extension) }}</span>
                                                    <span class="file-action">Click to Open</span>
                                                </div>
                                                <div class="download-overlay">
                                                    <i class="fas fa-download"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                <!-- Caption -->
                                <div class="card-content">
                                    <h3 class="card-title">{{ Str::limit($image->caption, 50) }}</h3>
                                    @if(strlen($image->caption) > 50)
                                        <p class="card-description">{{ $image->caption }}</p>
                                    @endif
                                    <div class="card-meta">
                                        <span class="file-type-badge {{ $itemType }}">
                                            {{ $isImage ? 'Image' : strtoupper($extension) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Button -->
                <div class="load-more-section">
                    <button class="load-more-btn" id="loadMoreBtn">
                        <span class="btn-text">Load More</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            @else
                <!-- Enhanced Empty State -->
                <div class="empty-gallery">
                    <div class="empty-animation">
                        <div class="empty-icon">
                            <i class="fas fa-{{ $type=='gallery' ? 'camera' : 'folder-open' }}"></i>
                        </div>
                        <div class="floating-elements">
                            <div class="float-item"></div>
                            <div class="float-item"></div>
                            <div class="float-item"></div>
                        </div>
                    </div>
                    <h3 class="empty-title">No {{ $type=='gallery' ? 'Photos' : 'Resources' }} Available</h3>
                    <p class="empty-description">
                        This collection is currently empty. Check back later for new {{ $type=='gallery' ? 'photos' : 'resources' }} and updates.
                    </p>
                    <a href="{{ route('swapno-gallery', ['type' => $type]) }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        Browse Other Collections
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('CustomStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d10000;
            --primary-light: #ff4757;
            --primary-dark: #a50000;
            --secondary-color: #2f3542;
            --accent-color: #ffc107;
            --success-color: #2ed573;
            --info-color: #3742fa;
            --warning-color: #ff6b35;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --gradient-5: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 20px 60px rgba(0, 0, 0, 0.3);
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            line-height: 1.6;
            background: #f8fafc;
            color: var(--text-dark);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Banner */
        .hero-banner {
            position: relative;
            background: var(--gradient-1);
            min-height: 60vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float-particle 8s infinite ease-in-out;
        }

        .particle:nth-child(1) { width: 10px; height: 10px; top: 20%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 6px; height: 6px; top: 60%; left: 80%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 8px; height: 8px; top: 40%; left: 60%; animation-delay: 4s; }
        .particle:nth-child(4) { width: 4px; height: 4px; top: 80%; left: 20%; animation-delay: 6s; }
        .particle:nth-child(5) { width: 12px; height: 12px; top: 30%; left: 90%; animation-delay: 1s; }
        .particle:nth-child(6) { width: 5px; height: 5px; top: 70%; left: 50%; animation-delay: 3s; }

        @keyframes float-particle {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.6; }
            50% { transform: translateY(-30px) rotate(180deg); opacity: 1; }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            width: 100%;
        }

        .breadcrumb-nav {
            margin-bottom: 2rem;
        }

        .breadcrumb-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .breadcrumb-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
            color: white;
        }

        .hero-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from { text-shadow: 0 0 20px rgba(255, 255, 255, 0.5); }
            to { text-shadow: 0 0 40px rgba(255, 255, 255, 0.8); }
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #fff, #f1f2f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            max-width: 700px;
            margin: 0 auto 2rem;
            opacity: 0.95;
            line-height: 1.8;
        }

        .gallery-stats {
            display: flex;
            justify-content: center;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Gallery Showcase */
        .gallery-showcase {
            padding: 4rem 0;
            background: #f8fafc;
        }

        /* Filter Controls */
        .filter-controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 50px;
            background: white;
            color: var(--text-dark);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Masonry Grid */
        .masonry-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .gallery-card {
            border-radius: 20px;
            overflow: hidden;
            background: white;
            box-shadow: var(--shadow-light);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-heavy);
        }

        .card-container {
            position: relative;
        }

        /* Image Items */
        .image-wrapper {
            position: relative;
            overflow: hidden;
            height: 280px;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.1);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-card:hover .image-overlay {
            opacity: 1;
        }

        .overlay-content {
            text-align: center;
            color: white;
        }

        .overlay-content i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .overlay-content span {
            font-size: 1rem;
            font-weight: 500;
        }

        /* Document Items */
        .document-wrapper {
            position: relative;
            height: 280px;
        }

        .document-preview {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.3s ease;
        }

        .file-pdf { background: linear-gradient(135deg, #ff6b6b, #ee5a52); }
        .file-csv { background: linear-gradient(135deg, #4ecdc4, #44a08d); }
        .file-xlsx, .file-xls { background: linear-gradient(135deg, #45b7d1, #96c93d); }
        .file-doc, .file-docx { background: linear-gradient(135deg, #667eea, #764ba2); }
        .file-ppt, .file-pptx { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .file-zip, .file-rar { background: linear-gradient(135deg, #ffecd2, #fcb69f); }
        .file-alt { background: linear-gradient(135deg, #a8edea, #fed6e3); }

        .file-icon {
            font-size: 4rem;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .file-info {
            text-align: center;
            color: white;
        }

        .file-type {
            display: block;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .file-action {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .download-overlay {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-card:hover .download-overlay {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Card Content */
        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .card-description {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .file-type-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .file-type-badge.images {
            background: rgba(67, 233, 123, 0.1);
            color: var(--success-color);
        }

        .file-type-badge.documents {
            background: rgba(58, 66, 250, 0.1);
            color: var(--info-color);
        }

        /* Load More Section */
        .load-more-section {
            text-align: center;
            margin-top: 3rem;
        }

        .load-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
        }

        .load-more-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Empty State */
        .empty-gallery {
            text-align: center;
            padding: 5rem 2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .empty-animation {
            position: relative;
            margin-bottom: 3rem;
        }

        .empty-icon {
            font-size: 6rem;
            color: #cbd5e0;
            margin-bottom: 2rem;
            animation: gentle-bounce 3s ease-in-out infinite;
        }

        @keyframes gentle-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 200px;
        }

        .float-item {
            position: absolute;
            width: 8px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 50%;
            opacity: 0.3;
            animation: float-around 4s infinite ease-in-out;
        }

        .float-item:nth-child(1) {
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .float-item:nth-child(2) {
            top: 60%;
            right: 20%;
            animation-delay: 1s;
        }

        .float-item:nth-child(3) {
            bottom: 20%;
            left: 50%;
            animation-delay: 2s;
        }

        @keyframes float-around {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .empty-title {
            font-size: 2.2rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .empty-description {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
        }

        .back-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .masonry-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .masonry-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1rem;
            }

            .filter-controls {
                gap: 0.5rem;
            }

            .filter-btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .gallery-showcase {
                padding: 2rem 0;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .masonry-grid {
                grid-template-columns: 1fr;
            }

            .image-wrapper,
            .document-wrapper {
                height: 240px;
            }

            .container {
                padding: 0 15px;
            }

            .filter-controls {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Animation Classes */
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .slide-up {
            transform: translateY(30px);
            opacity: 0;
            animation: slideUp 0.6s ease forwards;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Lightbox Customizations */
        .lb-data .lb-caption {
            font-size: 1.1rem;
            line-height: 1.6;
            padding: 1rem 0;
        }

        .lb-nav a.lb-prev,
        .lb-nav a.lb-next {
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .lb-nav a.lb-prev:hover,
        .lb-nav a.lb-next:hover {
            opacity: 1;
        }
    </style>
@endpush

@push('CustomJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Lightbox customization
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': true,
            'positionFromTop': 80,
            'disableScrolling': true,
            'fadeDuration': 300,
            'imageFadeDuration': 300
        });

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryCards = document.querySelectorAll('.gallery-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');

                    // Update active button
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Filter cards
                    galleryCards.forEach(card => {
                        const category = card.getAttribute('data-category');

                        if (filter === 'all' || category === filter) {
                            card.style.display = 'block';
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(20px)';

                            setTimeout(() => {
                                card.style.transition = 'all 0.5s ease';
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            }, 100);
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });

            // Load more functionality
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    // Add loading state
                    this.innerHTML = '<span class="btn-text">Loading...</span><i class="fas fa-spinner fa-spin"></i>';
                    this.disabled = true;

                    // Simulate loading
                    setTimeout(() => {
                        this.innerHTML = '<span class="btn-text">Load More</span><i class="fas fa-chevron-down"></i>';
                        this.disabled = false;
                    }, 2000);
                });
            }

            // Parallax effect for hero section
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.hero-banner');
                const speed = scrolled * 0.5;

                if (parallax) {
                    parallax.style.transform = `translateY(${speed}px)`;
                }
            });

            // Image lazy loading enhancement
            const images = document.querySelectorAll('.gallery-image');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.src;
                        img.classList.add('fade-in');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));

            // Enhanced card hover effects
            const cards = document.querySelectorAll('.gallery-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.zIndex = '10';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.zIndex = '1';
                });
            });

            // Smooth scroll for breadcrumb link
            const breadcrumbLink = document.querySelector('.breadcrumb-link');
            if (breadcrumbLink) {
                breadcrumbLink.addEventListener('click', function(e) {
                    // Add exit animation before navigation
                    document.body.style.opacity = '0.8';
                    document.body.style.transform = 'scale(0.98)';
                    document.body.style.transition = 'all 0.3s ease';

                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 200);

                    e.preventDefault();
                });
            }

            // Add entrance animations
            const heroContent = document.querySelector('.hero-content');
            if (heroContent) {
                heroContent.classList.add('slide-up');
            }

            // Dynamic gradient backgrounds for document cards
            const documentCards = document.querySelectorAll('.gallery-card.documents');
            const gradients = [
                'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                'linear-gradient(135deg, #fa709a 0%, #fee140 100%)'
            ];

            documentCards.forEach((card, index) => {
                const preview = card.querySelector('.document-preview');
                if (preview && !preview.className.includes('file-')) {
                    preview.style.background = gradients[index % gradients.length];
                }
            });

            // Add loading states for better UX
            const links = document.querySelectorAll('a[href]');
            links.forEach(link => {
                if (link.getAttribute('target') === '_blank') {
                    link.addEventListener('click', function() {
                        const icon = this.querySelector('i');
                        if (icon) {
                            const originalClass = icon.className;
                            icon.className = 'fas fa-spinner fa-spin';

                            setTimeout(() => {
                                icon.className = originalClass;
                            }, 1000);
                        }
                    });
                }
            });

            // Enhanced intersection observer for cards
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Apply observer to all cards
            document.querySelectorAll('.gallery-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `all 0.6s ease ${index * 0.1}s`;
                cardObserver.observe(card);
            });
        });

        // Performance optimization
        let ticking = false;
        function updateParallax() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero-banner');

            if (parallax) {
                parallax.style.transform = `translateY(${scrolled * 0.3}px)`;
            }

            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick);

        // Add custom cursor effect for gallery items
        document.addEventListener('mousemove', function(e) {
            const cursor = document.querySelector('.custom-cursor');
            if (cursor) {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
            }
        });

        // Keyboard navigation for gallery
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close any open modals or overlays
                const activeOverlay = document.querySelector('.image-overlay:hover');
                if (activeOverlay) {
                    activeOverlay.style.opacity = '0';
                }
            }
        });
    </script>
@endpush