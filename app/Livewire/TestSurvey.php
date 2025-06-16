<?php

namespace App\Livewire;

use App\Models\Agent;
use Illuminate\Http\Request;
use Livewire\Component;

class TestSurvey extends Component
{
    public $test;
    public $questions;
    public $ref;
    public $agent;
    public $is_ref = true;
    public $answers = [];
    public $answered = [];

    public $showPopup = false;


    public function openPopup()
    {
        $this->showPopup = true;
        $this->dispatch('toggle-body-scroll', enabled: true); // Новый синтаксис Livewire 3
    }

    public function showPopup()
    {
        $this->showPopup = true;
    }

    public function setDefaultValues()
    {
        foreach ($this->questions as $key => $qst) {
            $this->answers[$key] = "";
        }
    }

    public function submit()
    {
        foreach ($this->questions as $key => $qst) {
            if ($this->answers[$key] == "")
            {
                session()->flash('message', "Заполните все поля ввода!");
                $this->answered = [];
                return;
            } elseif(!$qst->answers[array_search($this->answers[$key],$qst->answers->pluck('text')->all())]->is_correct) {
                session()->flash('message', "Не все вопросы отвечены верно!");
                $this->answered = [];
                return;
            } else
            {
                $this->answered[$qst->text] = $this->answers[$key];
            }
        }

        $this->agent = Agent::find(session()->get('agent_id'));

        $this->agent->is_qualified = true;
        $this->agent->save();


        $this->openPopup();
    }

    public function mount(Request $request)
    {
        $test = request()->query('test');
        if ($test) {
            $this->test = \App\Models\Test::find($test);
            if ($this->test) {
                $this->questions = $this->test->questions;
            }
        } else {
            //Обработать ошибку
            //abort(404);
        }
        $this->setDefaultValues();
    }

    public function render()
    {
        return view('livewire.test-survey');
    }
}
