<?php

namespace App\Livewire;

use Livewire\Component;

class ProgressCircle extends Component
{
    public $currentLevel = 30;
    public $nextLevel = 50;
    public $levelColor = '#f44336';
    public $nextLevelColor = '#4caf50';

    // Инициализация компонента
    public function mount($currentLevel = 30, $nextLevel = 50)
    {
        $this->currentLevel = $currentLevel;
        $this->nextLevel = $nextLevel;
        $this->levelColor = $this->getColorForLevel($currentLevel);
    }

    private function getColorForLevel($level)
    {
        if ($level <= 30) return '#f44336';
        if ($level <= 60) return '#ff9800';
        return '#4caf50'; // Зеленый
    }

    public function render()
    {
        $progress = ($this->currentLevel / $this->nextLevel) * 100;
        $circumference = 2 * pi() * 45;
        $progressOffset = $circumference - ($circumference * $progress / 100);
        return view('livewire.progress-circle', compact('progress'), ['progressOffset' => $progressOffset]);
    }
    public function updateProgress($currentLevel, $nextLevel = null)
    {
        $this->currentLevel = $currentLevel;
        if ($nextLevel !== null) {
            $this->nextLevel = $nextLevel;
        }
    }
}
