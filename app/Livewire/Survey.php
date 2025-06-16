<?php

namespace App\Livewire;

use App\Models\Agent;
use App\Models\Anketa;
use App\Models\AnsweredAnketa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Survey extends Component
{
    public $anketa;
    public $questions;
    public $ref;
    public $is_ref = true;
    public $answers = [];
    public $answered = [];

    public $showPopup = false;

    public function setDefaultValues()
    {
        foreach ($this->questions as $key => $qst)
        {
            switch ($qst->type)
            {
                case("select");
                    $this->answers[$key] = $qst->answers[0]->text;
                break;

                case("bool");
                    $this->answers[$key] = false;
                break;

                case("checkbox");
                    $answers = $qst->answers;
                    foreach ($answers as $akey => $answer)
                    {
                        $this->answers[$key][$answer->text] = false;
                    }
                    break;

                default;
                    $this->answers[$key] = "";
                break;
            }
        }
    }

    public function openPopup()
    {
        $this->showPopup = true;
        $this->dispatch('toggle-body-scroll', enabled: true);
    }
    public function showPopup()
    {
        $this->showPopup = true;
    }

    public function submit()
    {
        foreach ($this->questions as $key => $qst)
        {
            switch ($qst->type)
            {
                case ("bool"):
                    $this->answered[$qst->text] = ($this->answers[$key]?"Да":"Нет");
                    break;
                case("select"):
                    $this->answered[$qst->text] = $this->answers[$key];
                    break;
                case("checkbox"):
                    $this->answered[$qst->text] = "";
                    foreach ($this->answers[$key] as $akey => $answer)
                    {
                        if($answer)
                        $this->answered[$qst->text] = $this->answered[$qst->text] . $akey . "; ";
                    }
                    $this->answered[$qst->text] = rtrim($this->answered[$qst->text], "; ");
                    break;
                default:
                    if($this->answers[$key] == "")
                    {
                        session()->flash('message', "Заполните все поля ввода!");
                        $this->answered = [];
                        return;
                    }
                    else
                    {
                        $this->answered[$qst->text] = $this->answers[$key];
                    }
                break;
            }
        }
        $stored = new AnsweredAnketa();
        $stored->answers = json_encode($this->answered);
        $stored->agent_id = $this->ref;
        $stored->anketa_id = $this->anketa->id;
        $stored->is_referral = $this->is_ref;
        $stored->save();

        $this->openPopup();
    }

    public function mount(Request $request)
    {
        $ank = request()->query('ank');
        if ($ank) {
            $this->anketa = Anketa::all()->find($ank);

            if ($this->anketa) {
                $this->questions = $this->anketa->questions;

                $is_ref = $request->query('is_ref');

                if ($is_ref != null) {
                    $this->is_ref = $is_ref;
                }

                $ref = request()->query('ref');
                $agent = Agent::all()->find($ref);

                if ($agent) {
                    $this->ref = $ref;
                } else {
                    //Обработать ошибку
                    abort(404);
                }
            }
        } else {
            //Обработать ошибку
            abort(404);
        }
        $this->setDefaultValues();
    }

    public function render()
    {
        return view('livewire.survey');
    }

}
