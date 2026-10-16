<x-filament-widgets::widget>
    <x-filament::section>
        <div style="position: relative; padding: 2.5rem 1rem; overflow: hidden; background: linear-gradient(135deg, #151515 0%, #1a1a1a 50%, #151515 100%); border-radius: 0.75rem; border: 1px solid rgba(218, 37, 29, 0.3);">
            
            <!-- Background Pattern -->
            <div style="position: absolute; inset: 0; opacity: 0.1; background-image: repeating-linear-gradient(45deg, #DA251D 0, #DA251D 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
            
            <!-- Left Accent -->
            <div style="position: absolute; top: 0; left: 0; width: 6px; height: 100%; background: linear-gradient(180deg, #DA251D, #FF512F);"></div>
            
            <!-- Right Accent -->
            <div style="position: absolute; top: 0; right: 0; width: 6px; height: 100%; background: linear-gradient(180deg, #FF512F, #DA251D);"></div>
            
            <!-- Bottom Glow Line -->
            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: #DA251D; box-shadow: 0 0 20px #DA251D, 0 0 40px rgba(218, 37, 29, 0.5);"></div>
            
            <!-- Content -->
            <div style="position: relative; z-index: 10; text-align: center;">
                <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 4px; background: rgba(139, 0, 0, 0.3); color: #ef4444; border: 1px solid rgba(210, 68, 68, 0.3); font-size: 0.7rem; font-weight: bold; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.75rem;">
                    Administrator Portal
                </span>
                
                <h1 style="font-size: 2rem; font-weight: 900; color: white; text-transform: uppercase; letter-spacing: -0.025em; margin-bottom: 0.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
                    Welcome, <span style="background: linear-gradient(90deg, #FF512F, #DA251D); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ auth()->user()->name }}</span>
                </h1>
                
                <p style="color: #9ca3af; margin-top: 0.5rem; font-size: 0.875rem; max-width: 32rem; margin-left: auto; margin-right: auto; margin-bottom: 1.5rem;">
                    Manage courses, users, and reports from this command center.
                </p>

                <a href="{{ route('dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #DA251D; color: white; font-weight: bold; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.875rem; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s; box-shadow: 0 0 20px rgba(218, 37, 29, 0.4);">
                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                    Go to Learner Portal
                </a>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
