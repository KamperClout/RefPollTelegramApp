<x-filament::widget>
    <x-filament::card>
        <div>
            <div class="text-sm text-gray-400">Одобренные</div>
            <div class="text-3xl font-bold">{{ $this->getData()['current'] }}</div>
            @php
                $direction = $this->getData()['direction'];
                $percent = abs($this->getData()['percent']);

                // Определяем цвета и стили в зависимости от значения
                if ($percent === 0 || $this->getData()['current'] === 0) {
                    $color = 'color: rgb(var(--gray-500));';
                    $lineColor = 'stroke: rgb(var(--gray-500));';
                    $fillColor = 'fill: rgba(107,114,128,0.15);'; // серый с прозрачностью
                } else {
                    $color = $direction === 'increase'
                        ? 'color: rgb(var(--success-500));'
                        : 'color: rgb(var(--danger-500));';
                    $lineColor = $direction === 'increase'
                        ? 'stroke: rgb(var(--success-500));'
                        : 'stroke: rgb(var(--danger-500));';
                    $fillColor = $direction === 'increase'
                        ? 'fill: rgba(34,197,94,0.15);'
                        : 'fill: rgba(239,68,68,0.15);';
                }
            @endphp
            <div class="flex items-center gap-1" style="{{ $color }}">
                @if($percent > 0 || $this->getData()['current'] > 0)
                    {{ $percent }}%
                    {{ $direction === 'increase' ? 'рост' : 'падение' }}
                    @if($direction === 'increase')
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    @endif
                @else
                    Нет изменений
                @endif
            </div>
        </div>
        <!-- Живая волна с заливкой -->
        <svg viewBox="0 0 100 24" width="100%" height="28" fill="none" preserveAspectRatio="none" style="margin-top: 12px;">
            @if($percent === 0 || $this->getData()['current'] === 0)
                <!-- Прямая линия для нулевого состояния -->
                <path d="M0 20 L100 20" stroke-width="2.5" style="{{ $lineColor }}" fill="none"/>
                <path d="M0 20 L100 20 L100 24 L0 24 Z" style="{{ $fillColor }}" />
            @else
                <!-- Волна для остальных состояний -->
                <path d="M0 20 Q 10 10 20 16 Q 30 22 40 14 Q 50 6 60 14 Q 70 22 80 16 Q 90 10 100 20 L100 24 L0 24 Z" style="{{ $fillColor }}" />
                <path d="M0 20 Q 10 10 20 16 Q 30 22 40 14 Q 50 6 60 14 Q 70 22 80 16 Q 90 10 100 20" stroke-width="2.5" style="{{ $lineColor }}" fill="none"/>
            @endif
        </svg>
    </x-filament::card>
</x-filament::widget>
