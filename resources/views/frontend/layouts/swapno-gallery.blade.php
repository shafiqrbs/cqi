
@extends('frontend.layouts.app')
@section('content')
    <!-- Hero Section with Particles -->
    <div class="hero-section">
        <div class="particles-container">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-icon">
                    @if($type=='gallery')
                        <i class="fas fa-camera-retro"></i>
                    @else
                        <i class="fas fa-file-archive"></i>
                    @endif
                </div>
                <h1 class="hero-title">Our {{$type=='gallery'?'Photo':'Resource'}} Collection</h1>
                @if($type=='gallery')
                    <p class="hero-subtitle">
                        Discover unforgettable moments captured through our lens. Each gallery tells a unique story waiting to be explored.
                    </p>
                @else
                    <p class="hero-subtitle">
                        Access our comprehensive resource library. Download PDFs, documents, and materials to enhance your experience.
                    </p>
                @endif
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ count($galleries) }}</span>
                        <span class="stat-label">{{$type=='gallery'?'Galleries':'Resources'}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="gallery-section">
        <div class="container">
            @if($galleries && count($galleries) > 0)
                <div class="gallery-grid">
                    @foreach($galleries as $index => $gallery)
                        <div class="gallery-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <a href="{{route('swapno-gallery-details', $gallery->id)}}" class="card-link">
                                <div class="card-background"></div>
                                <div class="card-content">
                                    <div class="card-icon">
                                        @if($type=='gallery')
                                            <i class="fas fa-images"></i>
                                        @else
                                            <i class="fas fa-folder-open"></i>
                                        @endif
                                    </div>
                                    <h3 class="card-title">{{ $gallery->name }}</h3>
                                    <p class="card-description">Click to explore collection</p>
                                    <div class="card-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="card-glow"></div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-{{ $type=='gallery' ? 'camera' : 'folder-open' }}"></i>
                    </div>
                    <h3 class="empty-title">No {{$type=='gallery'?'Galleries':'Resources'}} Available</h3>
                    <p class="empty-description">
                        We're working on adding new {{$type=='gallery'?'photo collections':'resources'}}. Check back soon for exciting updates!
                    </p>
                    <div class="empty-animation">
                        <div class="loading-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
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
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --gradient-5: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-light: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 15px 35px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 25px 50px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 60vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.4;
        }

        .particles-container {
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

        .particle:nth-child(1) {
            width: 8px;
            height: 8px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 4px;
            height: 4px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 6px;
            height: 6px;
            top: 40%;
            left: 60%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            width: 3px;
            height: 3px;
            top: 80%;
            left: 20%;
            animation-delay: 6s;
        }

        .particle:nth-child(5) {
            width: 5px;
            height: 5px;
            top: 30%;
            left: 90%;
            animation-delay: 1s;
        }

        @keyframes float-particle {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.6;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            text-align: center;
            color: white;
        }

        .hero-icon {
            font-size: 4rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
                transform: scale(1);
            }
            to {
                text-shadow: 0 0 30px rgba(255, 255, 255, 0.8);
                transform: scale(1.05);
            }
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #fff, #f1f2f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto 3rem;
            opacity: 0.95;
            line-height: 1.7;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Gallery Section */
        .gallery-section {
            padding: 5rem 0;
            position: relative;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .gallery-card {
            position: relative;
            height: 280px;
            border-radius: 24px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .gallery-card:nth-child(5n+1) .card-background { background: var(--gradient-1); }
        .gallery-card:nth-child(5n+2) .card-background { background: var(--gradient-2); }
        .gallery-card:nth-child(5n+3) .card-background { background: var(--gradient-3); }
        .gallery-card:nth-child(5n+4) .card-background { background: var(--gradient-4); }
        .gallery-card:nth-child(5n+5) .card-background { background: var(--gradient-5); }

        .card-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: all 0.4s ease;
        }

        .card-link {
            display: block;
            width: 100%;
            height: 100%;
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        .card-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
            color: white;
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            transition: all 0.3s ease;
        }

        .card-description {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .card-arrow {
            font-size: 1.2rem;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .card-glow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        /* Hover Effects */
        .gallery-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-heavy);
        }

        .gallery-card:hover .card-background {
            transform: scale(1.1);
        }

        .gallery-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .gallery-card:hover .card-title {
            transform: translateY(-2px);
        }

        .gallery-card:hover .card-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        .gallery-card:hover .card-glow {
            opacity: 1;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-icon {
            font-size: 5rem;
            color: #cbd5e0;
            margin-bottom: 2rem;
            animation: gentle-bounce 2s ease-in-out infinite;
        }

        @keyframes gentle-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .empty-title {
            font-size: 2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .empty-description {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .loading-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .loading-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary-color);
            animation: loading-bounce 1.4s ease-in-out infinite both;
        }

        .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
        .loading-dots span:nth-child(2) { animation-delay: -0.16s; }

        @keyframes loading-bounce {
            0%, 80%, 100% {
                transform: scale(0);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-icon {
                font-size: 3rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .gallery-card {
                height: 240px;
            }

            .stat-item {
                padding: 1rem 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                min-height: 50vh;
            }

            .hero-title {
                font-size: 2rem;
            }

            .container {
                padding: 0 15px;
            }

            .gallery-section {
                padding: 3rem 0;
            }

            .gallery-card {
                height: 200px;
            }

            .card-content {
                padding: 1.5rem;
            }

            .card-icon {
                font-size: 2.5rem;
            }

            .card-title {
                font-size: 1.3rem;
            }
        }

        /* Loading Animation */
        [data-aos] {
            opacity: 0;
            transition-property: opacity, transform;
        }

        [data-aos].aos-animate {
            opacity: 1;
        }

        [data-aos="fade-up"] {
            transform: translate3d(0, 100px, 0);
        }

        [data-aos="fade-up"].aos-animate {
            transform: translate3d(0, 0, 0);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Enhanced focus states for accessibility */
        .gallery-card:focus-within {
            outline: 3px solid var(--accent-color);
            outline-offset: 2px;
        }

        .card-link:focus {
            outline: none;
        }
    </style>
@endpush

@push('CustomJs')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100
        });

        // Lightbox customization
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': true,
            'positionFromTop': 100,
            'disableScrolling': true
        });

        // Add parallax effect to hero section
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero-section');
            const speed = scrolled * 0.5;

            if (parallax) {
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });

        // Enhanced card interactions
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.gallery-card');

            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.zIndex = '10';

                    // Add subtle tilt effect
                    this.addEventListener('mousemove', handleMouseMove);
                });

                card.addEventListener('mouseleave', function() {
                    this.style.zIndex = '1';
                    this.style.transform = 'translateY(-8px) scale(1.02) perspective(1000px) rotateX(0deg) rotateY(0deg)';

                    this.removeEventListener('mousemove', handleMouseMove);
                });
            });

            function handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                card.style.transform = `translateY(-8px) scale(1.02) perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            }
        });

        // Add loading animation for dynamic content
        function showLoadingAnimation() {
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) {
                const dots = emptyState.querySelectorAll('.loading-dots span');
                dots.forEach((dot, index) => {
                    setTimeout(() => {
                        dot.style.animationPlayState = 'running';
                    }, index * 200);
                });
            }
        }

        // Performance optimization: Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe all gallery cards
        document.querySelectorAll('.gallery-card').forEach(card => {
            observer.observe(card);
        });

        // Initialize loading animation
        showLoadingAnimation();
    </script>
@endpush