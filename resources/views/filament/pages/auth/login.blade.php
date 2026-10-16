<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <style>
        .login-bg-animate {
            background: linear-gradient(-45deg, #111827, #1f2937, #0f172a, #374151);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            position: fixed;
            inset: 0;
            z-index: -20;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-grid {
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cpath d='M10 10H90V90H10z' fill='none' stroke='white' stroke-opacity='0.1' stroke-width='0.5'/%3E%3C/svg%3E");
            background-size: 50px 50px;
            z-index: -15;
            mask-image: linear-gradient(180deg, white, rgba(255,255,255,0));
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -10;
            animation: blob 10s infinite;
        }

        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        /* Style the card to match glassmorphism */
        .fi-simple-page {
            background: rgba(17, 24, 39, 0.6) !important;
            backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
            padding: 2.5rem !important;
            border-radius: 1.5rem !important;
            width: 100% !important;
            max-width: 28rem !important;
            position: relative;
            z-index: 10;
        }

        .fi-simple-page input {
            background: rgba(0, 0, 0, 0.2) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
        }
        
        .fi-simple-page button[type="submit"] {
            background: linear-gradient(to right, #DA251D, #991b1b) !important;
            box-shadow: 0 10px 15px -3px rgba(218, 37, 29, 0.3) !important;
            transition: all 0.3s !important;
        }
        
        .fi-simple-page button[type="submit"]:hover {
            transform: scale(1.02) !important;
            filter: brightness(110%) !important;
        }

        /* Hide default simple header since we use custom one */
        .fi-simple-header {
            display: none !important;
        }
    </style>

    <div class="login-bg-animate" wire:ignore></div>
    <div class="login-grid" wire:ignore></div>
    
    <div class="blob w-[400px] h-[400px] bg-[#DA251D]/10 top-0 left-0 -translate-x-1/2 -translate-y-1/2" wire:ignore></div>
    <div class="blob w-[400px] h-[400px] bg-blue-600/10 bottom-0 right-0 translate-x-1/2 translate-y-1/2" style="animation-delay: 2s;" wire:ignore></div>

    <div class="flex flex-col items-center mb-8 text-center relative z-10">
        <div class="bg-white p-2 rounded-xl shadow-lg mb-4">
            <img src="{{ asset('logo.png') }}" class="h-8 w-auto" alt="Logo">
        </div>
        <h1 class="text-2xl font-bold text-white font-raleway tracking-tight">
            SPINDO <span class="text-[#DA251D]">ADMIN</span>
        </h1>
        <p class="text-gray-400 text-sm mt-1">Personnel Learning Management</p>
    </div>

    <div class="fi-simple-page">
        {{ $this->content }}
    </div>
    
    <p class="text-center text-gray-500 text-xs mt-8 opacity-60 relative z-10">© {{ date('Y') }} All Rights Reserved</p>
</div>
