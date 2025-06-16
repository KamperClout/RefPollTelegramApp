<div class="space-y-4">
    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="font-medium text-lg mb-4 text-gray-900 dark:text-white">Информация о записи:</div>
        <div class="space-y-2 text-gray-600 dark:text-gray-300">
            <div class="flex items-center">
                <span class="font-medium w-32">Модель:</span>
                <span>{{ match($record->subject_type) {
                    'App\\Models\\Agent' => 'Агент',
                    'App\\Models\\Anketa' => 'Анкета',
                    default => $record->subject_type,
                } }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-32">ID записи:</span>
                <span>{{ $record->subject_id }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-32">Действие:</span>
                <span>{{ match($record->description) {
                    'created' => 'Создание',
                    'updated' => 'Обновление',
                    'deleted' => 'Удаление',
                    default => $record->description,
                } }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-32">Дата:</span>
                <span>{{ $record->created_at->format('d.m.Y H:i') }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-32">Пользователь:</span>
                <span>{{ $record->causer?->name ?? 'Система' }}</span>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="font-medium text-lg mb-4 text-gray-900 dark:text-white">Изменения:</div>
        <div class="space-y-4">
            @foreach($changes as $change)
                <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    {!! $change !!}
                </div>
            @endforeach
        </div>
    </div>
</div>
