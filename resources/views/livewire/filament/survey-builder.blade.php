<div>
    <div class="flex gap-4 mb-4">
        <div>
            <label class="block font-bold mb-1">Вопрос:</label>
            <select wire:model="selectedQuestion" class="filament-input w-full">
                <option value="">—</option>
                @foreach($this->getQuestions() as $text)
                    <option value="{{ $text }}">{{ $text }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-bold mb-1">Тип графика:</label>
            <select wire:model="chartType" class="filament-input w-full">
                <option value="bar">Столбчатый</option>
                <option value="pie">Круговой</option>
                <option value="percent">Процентный</option>
            </select>
        </div>
    </div>

    @if($selectedQuestion)
        @php
            $variants = $this->getVariants();
            $canvasId = 'interactiveChart_' . md5($selectedQuestion . $this->chartType);
        @endphp
        <pre>{{ var_export($variants, true) }}</pre>
        @if(count($variants))
            <canvas id="{{ $canvasId }}" height="200"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                function drawInteractiveChart() {
                    let canvasId = "{{ $canvasId }}";
                    let ctx = document.getElementById(canvasId);
                    if (!ctx) { console.log('Canvas not found', canvasId); return; }
                    ctx = ctx.getContext('2d');
                    if(window.interactiveChartInstance) {
                        window.interactiveChartInstance.destroy();
                    }
                    window.interactiveChartInstance = new Chart(ctx, {
                        type: "{{ $chartType === 'percent' ? 'bar' : $chartType }}",
                        data: {
                            labels: {!! json_encode(array_keys($variants)) !!},
                            datasets: [{
                                label: "{{ $chartType === 'percent' ? 'Процент' : 'Количество' }}",
                                data: {!! json_encode(array_values($variants)) !!},
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            indexAxis: '{{ $chartType === 'bar' || $chartType === 'percent' ? 'y' : 'x' }}',
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    @if($chartType === 'percent')
                                    max: 100,
                                    ticks: {
                                        callback: function(value) {
                                            return value + '%';
                                        }
                                    }
                                    @endif
                                }
                            }
                        }
                    });
                }
                document.addEventListener('livewire:load', function () {
                    setTimeout(drawInteractiveChart, 100);
                });
                Livewire.hook('message.processed', (message, component) => {
                    setTimeout(drawInteractiveChart, 100);
                });
            </script>
        @else
            <div class="text-gray-500">Нет данных для выбранного вопроса.</div>
        @endif
    @endif
</div>
