<?php

use App\Enums\CacheTtl;
use App\Enums\CacheKeys;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

new class extends Component {
    #[Computed]
    public function articles(): array
    {
        return Cache::remember(
            key: CacheKeys::LATEST_ARTICLES->value,
            ttl: CacheTtl::HOUR->value,
            callback: function () {
                return Article::query()
                    ->select('articles.id', 'articles.name', 'articles.slug', 'articles.description', 'articles.image', 'articles.partner_id')
                    ->with(relations: ['partner'])
                    ->whereHas(relation: 'partner',
                        callback: fn(Builder $builder): Builder => $builder->where(
                            column: 'active',
                            operator: '=',
                            value: true,
                        ))
                    ->latest()
                    ->limit(6)
                    ->get()
                    ->toArray();
            });
    }
}; ?>
<div class="mt-10 grid gap-4 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">
    @foreach($this->articles as $article)
        <div class="relative">
            <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-4xl"></div>
            <div
                class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
                <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                    <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 text-center max-lg:text-center">
                        {{ $article['name'] }}
                    </p>
                    <p class="mt-2 max-w-lg text-sm/6 text-gray-600 text-justify max-lg:text-center">
                        {{ $article['description'] }}
                    </p>

                    @if(!empty($article['partner']['name']))
                        <p class="mt-2 max-w-lg text-sm/6 text-red-600 text-justify max-lg:text-center">
                            Partner: {{ $article['partner']['name'] }}
                        </p>
                    @endif

                    <p class="mt-2 max-w-lg text-sm/6 text-red-600 text-justify max-lg:text-center">
                        <a href="{{ route('article.show', $article['slug']) }}">Подробнее...</a>
                    </p>

                </div>
                <div class="flex flex-1 items-center justify-center px-8 max-lg:pt-10 max-lg:pb-12 sm:px-10 lg:pb-2">
                    <img src="{{ asset('images/no_image.png') }}" alt="" class="w-full max-lg:max-w-xs"/>
                </div>
            </div>
            <div
                class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5 max-lg:rounded-t-4xl"></div>
        </div>
    @endforeach

</div>

