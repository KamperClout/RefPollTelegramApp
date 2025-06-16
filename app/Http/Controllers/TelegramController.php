<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\In;

class TelegramController extends Controller
{


    public function webhook(Request $request)
    {
        $update = $request->all();

        if (isset($update['message'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'];

            $this->sendMessage($chatId, "You said: " . $text);
        }

        return response('ok', 200);
    }

    //Регистрация и авторизация
    public function getTgUsername(Request $request)
    {
        $data = $request->get('data');
        $inv = $request->get('inv');
        $phone = $request->get('phone');
        $username = $request->get('username');
        $storedId = session()->get("tg_id");
        //Если Id в сессии отсутствует/не совпадает с текущим
        if($storedId == null || $storedId != $data)
        {
            //Ищем агента по полученному Id
            $agent = Agent::where('tg_id', $data)->first();
            //Если агент не найден
            if ($agent == null)
            {
                $agent = new Agent();
                $agent->tg_id = $data;
                $agent->phone = $phone;
                $agent->name = $username;
                $agent->save();
                $agent = Agent::where('tg_id', $data)->first();
                session(['agent_id'=>$agent->id, 'tg_id' => $data]);
                if($inv != null)
                {
                    //Указать, что пользователь приглашен inv
                    $inviter = Agent::find($inv);
                    if($inviter)
                    {
                        $invite = new Invite();
                        $invite->inviter_id = $inv;
                        $invite->invited_id = $agent->id;
                        $invite->save();
                        $inviter->wallet->deposit(1000, "Доход от приглашения пользователя");

                        $inviterInv = $inviter->getInviter();
                        if($inviterInv)
                        {
                            $inviterInv->wallet->deposit(100, "Доход от приглашенного пользователя другом");
                        }
                    }
                }
            }
            //Если агент найден
            else
            {
                if($agent->phone == null || $agent->phone == "")
                {
                    $agent->phone = $phone;
                    $agent->save();
                }
                if($agent->name == null || $agent->name == "")
                {
                    $agent->name = $username;
                    $agent->save();
                }

                session(['agent_id'=>$agent->id, 'tg_id' => $data]);
            }
        }
        else
        {
            $agent = Agent::where('tg_id', $data)->first();

            if ($agent != null)
            {
                if($agent->phone == null || $agent->phone == "")
                {
                    $agent->phone = $phone;
                    $agent->save();
                }
                if($agent->name == null || $agent->name == "")
                {
                    $agent->name = $username;
                    $agent->save();
                }
            }
        }

        return response()->json(['success' => true]);
    }

    public function saveConsent(Request $request)
    {
        return response()->json(['success' => true]);
    }

    public function checkConsent(Request $request)
    {
        $tg_id = $request->get('tg_id');
        $agent = Agent::where('tg_id', $tg_id)->first();
        if ($agent != null)
        {
            if($agent->phone != null || $agent->phone != "")
            {
                return response()->json(['consent_given' => true]);
            }
            return response()->json(['consent_given' => false]);
        }
        else
        {
            return response()->json(['consent_given' => false]);
        }

    }


    private function sendMessage($chatId, $message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        return $response->body();
    }
}
