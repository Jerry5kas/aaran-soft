<?php

namespace App\Livewire\Sundar\Trading;

use Aaran\Sundar\Models\ShareTrades;
use App\Livewire\Trait\CommonTrait;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Options extends Component
{
    #region[property]
    use CommonTrait;

    public $vdate;
    public mixed $option_profit;
    public mixed $option_loosed;
    public mixed $user_id = '';
    public $remarks = '';
    public mixed $search_user_id = '';

    public mixed $users;

    #endregion

    public function mount()
    {
        $this->users = User::all();
    }


    #region[save]
    public function getSave(): string
    {
        if ($this->vid == "") {
            ShareTrades::create([
                'user_id' => $this->user_id ?: auth()->id(),
                'vdate' => $this->vdate ?: Carbon::now()->format('Y-m-d'),
                'opening_balance' => 0,
                'deposit' => 0,
                'withdraw' => 0,
                'share_profit' => 0,
                'share_loosed' => 0,
                'option_profit' => $this->option_profit ?: 0,
                'option_loosed' => $this->option_loosed ?: 0,
                'charges' => 0,
                'remarks' => $this->remarks ?: '',
                'active_id' => $this->active_id,

            ]);
            $message = "Saved";

        } else {
            $obj = ShareTrades::find($this->vid);
            $obj->user_id = $this->user_id;
            $obj->vdate = $this->vdate;
            $obj->option_profit = $this->option_profit ?: 0;
            $obj->option_loosed = $this->option_loosed ?: 0;
            $obj->remarks = $this->remarks;
            $obj->active_id = $this->active_id;

            $obj->save();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);

        return '';
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = ShareTrades::find($id);
            $this->vid = $obj->id;
            $this->user_id = $obj->user_id;
            $this->vdate = $obj->vdate;
            $this->option_profit = $obj->option_profit;
            $this->option_loosed = $obj->option_loosed;
            $this->remarks = $obj->remarks;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[getList]
    public function getList()
    {
        $this->sortField = 'vdate';

        if ($this->search_user_id == '') {
            $this->search_user_id = auth()->id();
        }

        return ShareTrades::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->where('option_profit', '>', 0)
            ->orwhere('option_loosed', '>', 0)
            ->where("user_id", $this->search_user_id)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[clearFields]
    public function clearFields(): void
    {
        $this->vid = '';
        $this->user_id = '';
        $this->vdate = Carbon::now()->format('Y-m-d');
        $this->option_profit = '';
        $this->option_loosed = '';
        $this->remarks = '';
        $this->active_id = '1';
    }
    #endregion

    #region[getRoute]
    public function getRoute()
    {
        $this->redirect(route('shareTrades'));
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('livewire.sundar.trading.options')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
