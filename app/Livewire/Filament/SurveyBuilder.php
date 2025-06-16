<?php

namespace App\Livewire\Filament;

use Livewire\Component;

class SurveyBuilder extends Component
{
    public $questions = [];

    public function mount($questions = [])
    {
        $this->questions = $questions;
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'text' => '',
            'type' => 'text',
            'answers' => [],
        ];
    }

    public function removeQuestion($i)
    {
        unset($this->questions[$i]);
        $this->questions = array_values($this->questions);
    }

    public function addAnswer($i)
    {
        $this->questions[$i]['answers'][] = ['text' => ''];
    }

    public function removeAnswer($i, $j)
    {
        unset($this->questions[$i]['answers'][$j]);
        $this->questions[$i]['answers'] = array_values($this->questions[$i]['answers']);
    }

    public function render()
    {
        return view('livewire.filament.survey-builder');
    }
}
