<?php

namespace App\Http\Controllers;

use App\Events\SlotEvent;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application chat.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showSlot()
    {
        return view('slot.show');
    }

    public function saveBets(Request $request)
    {
        Slot::create([
            'bet_number' => $request->bet_number,
            'users_id' => $request->user()->id,
            'won' => $request->won,
        ]);
        $slots = array();
        $slots[] = (object) [
            'won_count' => 0,
            'losses_count' => 0,
        ];
        $slots[0]->won_count = Slot::where('users_id', $request->user()->id)->where('won', true)->count();

        $slots[0]->losses_count = Slot::where('users_id', $request->user()->id)->where('won', false)->count();
        //     'losses' => function (Builder $query) {
        //         $query->where('won', false);
        //     }
        // ])->get();
        $message = "";
        if ($slots[0]->won_count == 0 && $slots[0]->losses_count >= 1) {
            $message = " perdió!";
        }
        if ($slots[0]->won_count == 0 && $slots[0]->losses_count >= 5) {
            $message = " perdió otra vez 🙄!";
        }
        if ($slots[0]->won_count == 0 && $slots[0]->losses_count >= 10) {
            $message = " perdió díganle que ya se salga 😅!";
        }
        if ($slots[0]->won_count == 1 && $slots[0]->losses_count >= 1) {
            $message = " ganó!";
            Slot::where('users_id', $request->user()->id)->delete();
        }
        if ($slots[0]->won_count == 1 && $slots[0]->losses_count >= 6) {
            $message = " ganó al fin!";
            Slot::where('users_id', $request->user()->id)->delete();
        }
        $message = $request->user()->name . " $message";
        broadcast(new SlotEvent($request->user(), $message));

        return response()->json(['message' => $message]);
    }
}
