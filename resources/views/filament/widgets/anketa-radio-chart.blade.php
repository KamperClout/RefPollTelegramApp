<x-filament-widgets::widget>
    <x-filament::card>
        <div class="h-full">
            <h3 class="text-lg font-semibold text-gray-950 dark:text-white mb-4">{{ $this->getHeading() }}</h3>
            <div class="h-64"> {{-- Задаем фиксированную высоту для контейнера графика --}}
                <canvas
                    x-data="{
                        chart: null,
                        init() {
                            let chart = new Chart($el, {
                                type: @js($this->getType()),
                                data: @js($this->getData()),
                                options: @js($this->getOptions()),
                            })
                            $wire.on('updateChart', async ({ data }) => {
                                chart.data = data
                                chart.update()
                            })
                        },
                    }"
                    wire:ignore
                ></canvas>
            </div>
        </div>
    </x-filament::card>
    @include('filament-charts::widgets.chart-script') {{-- Добавляем этот включаемый файл для загрузки Chart.js --}}
</x-filament-widgets::widget>
