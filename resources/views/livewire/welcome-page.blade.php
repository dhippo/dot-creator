<section class="relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-6 pt-20 pb-24 text-center">
        <!-- Kicker (petit sous-titre au-dessus) -->
        <p class="uppercase tracking-widest text-gray-400 text-xs md:text-sm mb-3">
            {{ __('welcome.kicker') }}
        </p>

        <!-- Titre principal -->
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">
            {{ __('welcome.title') }}
        </h1>

        <!-- Sous-titre -->
        <p class="text-base md:text-lg text-gray-300 max-w-3xl mx-auto mb-10">
            {{ __('welcome.subtitle') }}
        </p>

        <!-- CTA -->
        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('register') }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-md bg-white text-black font-medium hover:opacity-90">
                {{ __('welcome.cta_primary') }}
            </a>
            <a href="{{ route('login') }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-md border border-gray-700 text-white hover:bg-gray-900">
                {{ __('welcome.cta_secondary') }}
            </a>
        </div>
    </div>

    <!-- Subtle gradient/backdrop (facultatif, simple déco) -->
    <div class="pointer-events-none absolute inset-0 -z-10 opacity-40"
         style="background: radial-gradient(60% 40% at 50% 10%, rgba(99,102,241,0.3), transparent 60%);">
    </div>
</section>
