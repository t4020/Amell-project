<x-guest-layout>

    {{-- ─── Hero ──────────────────────────────────────────────────── --}}
    <section class="bg-piano border-b border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center">

            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-pearl leading-[1.1]">
                Explore Services
            </h1>
            <p class="mt-4 text-pearl/45 text-base sm:text-lg font-normal max-w-sm mx-auto leading-relaxed">
                Find the right professional for any job.
            </p>

            {{-- Search bar --}}
            <form method="GET" action="{{ route('explore') }}" class="mt-10 sm:mt-12 max-w-3xl mx-auto" role="search">
                <div class="flex h-14 rounded-2xl overflow-hidden bg-white shadow-[0_4px_32px_rgba(0,0,0,0.2)] ring-1 ring-white/10">

                    {{-- Catalog select --}}
                    <div class="relative border-r border-piano/[0.07] shrink-0">
                        <select
                            name="service"
                            aria-label="Filter by service"
                            onchange="this.form.requestSubmit ? this.form.requestSubmit() : this.form.submit()"
                            class="h-full w-full appearance-none bg-transparent pl-4 pr-9 text-sm font-medium text-piano border-0 focus:ring-0 focus:outline-none cursor-pointer min-w-[140px] sm:min-w-[180px]"
                        >
                            <option value="">All services</option>
                            @php $grouped = $catalogServices->groupBy(fn($s) => $s->category?->name ?? 'Other'); @endphp
                            @foreach($grouped->sortKeys() as $groupName => $items)
                                <optgroup label="{{ $groupName }}">
                                    @foreach($items->sortBy('title') as $svc)
                                        <option value="{{ $svc->id }}" @selected((string) request('service') === (string) $svc->id)>
                                            {{ $svc->title }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 w-[0.9rem] h-[0.9rem] text-piano/35" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    {{-- Text search --}}
                    <div class="relative flex-1 flex items-center min-w-0">
                        <svg class="pointer-events-none absolute left-4 w-4 h-4 text-piano/28 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            id="explore-search"
                            type="search"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search titles &amp; descriptions…"
                            autocomplete="off"
                            enterkeyhint="search"
                            class="h-full w-full pl-10 pr-3 text-sm text-piano placeholder:text-piano/32 bg-transparent border-0 focus:ring-0 focus:outline-none"
                        />
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="shrink-0 h-full px-6 sm:px-8 bg-piano text-pearl text-sm font-semibold tracking-wide hover:bg-[#1a1a1a] active:scale-[0.97] transition-all duration-150"
                    >
                        Search
                    </button>
                </div>

                {{-- Active filter badge --}}
                @if(request()->filled('q') || request()->filled('service'))
                    <div class="mt-4 flex items-center justify-center gap-1.5">
                        <span class="text-pearl/35 text-xs">Filtered</span>
                        <span class="text-pearl/20 text-xs">·</span>
                        <a href="{{ route('explore') }}" class="text-xs text-pearl/45 hover:text-pearl/80 underline underline-offset-2 decoration-pearl/20 transition-colors">
                            Clear
                        </a>
                    </div>
                @endif
            </form>

        </div>
    </section>

    {{-- ─── Content ─────────────────────────────────────────────── --}}
    @php
        $selectedCatalog = request()->filled('service')
            ? $catalogServices->firstWhere('id', (int) request('service'))
            : null;
        $hasFilters = request()->filled('q') || request()->filled('service');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-20">

        {{-- Category tabs --}}
        <div class="flex items-center gap-1 overflow-x-auto no-scrollbar border-b border-piano/[0.07] mb-10">
            <a
                href="{{ route('explore') }}"
                class="shrink-0 pb-3 px-1 mr-3 text-sm border-b-2 transition-colors duration-150 {{ request()->routeIs('explore') ? 'border-piano text-piano font-semibold' : 'border-transparent text-piano/45 hover:text-piano font-medium' }}"
            >
                All
            </a>
            @foreach($categories as $cat)
                <a
                    href="{{ route('category.show', $cat->slug) }}"
                    class="shrink-0 pb-3 px-1 mr-3 text-sm border-b-2 border-transparent text-piano/45 hover:text-piano font-medium transition-colors duration-150"
                >
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- Results meta --}}
        @if($hasFilters)
            <p class="text-sm text-piano/45 mb-8 -mt-2">
                @if($services->total() > 0)
                    {{ $services->total() }} {{ $services->total() === 1 ? 'result' : 'results' }}
                    @if($selectedCatalog)
                        &nbsp;·&nbsp; {{ $selectedCatalog->title }}
                    @endif
                    @if(request()->filled('q'))
                        &nbsp;·&nbsp; "<span class="text-piano">{{ e(request('q')) }}</span>"
                    @endif
                @else
                    No results
                    @if($selectedCatalog) for {{ $selectedCatalog->title }}@endif
                    @if(request()->filled('q')) matching "{{ e(request('q')) }}"@endif
                    &nbsp;·&nbsp;
                    <a href="{{ route('explore') }}" class="text-piano underline-offset-2 underline">Browse all</a>
                @endif
            </p>
        @endif

        {{-- Grid --}}
        @if($services->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
                @foreach($services as $service)
                    <article class="group flex flex-col rounded-2xl border border-piano/[0.07] bg-white hover:border-piano/[0.14] hover:shadow-[0_6px_28px_rgba(0,0,0,0.08)] transition-all duration-250">
                        <div class="p-5 flex-1 flex flex-col">
                            <span class="text-[0.6rem] font-semibold uppercase tracking-[0.18em] text-piano/35 mb-3 block">
                                {{ $service->category->name }}
                            </span>
                            <h3 class="text-[0.95rem] font-semibold text-piano leading-snug mb-2.5 group-hover:text-piano/75 transition-colors">
                                {{ $service->title }}
                            </h3>
                            <p class="text-[0.8rem] text-piano/48 leading-relaxed line-clamp-2 flex-1">
                                {{ $service->description }}
                            </p>
                        </div>

                        <div class="px-5 py-4 border-t border-piano/[0.06] flex items-center justify-between">
                            <a href="{{ route('worker.profile', $service->user) }}" class="flex items-center gap-2 group/w min-w-0">
                                <div class="w-6 h-6 rounded-full bg-piano text-pearl flex items-center justify-center text-[0.6rem] font-bold shrink-0">
                                    {{ strtoupper(substr($service->user->name, 0, 1)) }}
                                </div>
                                <span class="text-[0.78rem] font-medium text-piano/55 group-hover/w:text-piano truncate transition-colors">
                                    {{ Str::before($service->user->name, ' ') }}
                                </span>
                            </a>
                            <span class="text-sm font-bold text-piano tabular-nums shrink-0 ml-2">
                                ${{ number_format($service->price, 0) }}
                            </span>
                        </div>

                        <div class="px-4 pb-4">
                            <a
                                href="{{ route('requests.create', ['service_id' => $service->id]) }}"
                                class="flex w-full items-center justify-center rounded-xl bg-piano text-pearl text-[0.8rem] font-semibold py-2.5 hover:bg-[#1a1a1a] active:scale-[0.98] transition-all duration-150"
                            >
                                Request
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-14">
                {{ $services->links() }}
            </div>

        @else
            @if($hasFilters)
                <div class="py-28 text-center">
                    <p class="text-sm text-piano/35">Nothing matched your filters.</p>
                    <a href="{{ route('explore') }}" class="mt-3 inline-block text-sm text-piano underline underline-offset-2 decoration-piano/25 hover:decoration-piano transition-colors">
                        Clear and browse all
                    </a>
                </div>
            @else
                <div class="py-28 text-center border border-dashed border-piano/12 rounded-3xl">
                    <p class="text-sm text-piano/35">No services listed yet.</p>
                </div>
            @endif
        @endif

    </div>

</x-guest-layout>
