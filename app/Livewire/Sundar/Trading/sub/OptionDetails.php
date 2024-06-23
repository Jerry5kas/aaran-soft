<?php

namespace App\Livewire\Sundar\Trading\sub;

use Aaran\Sundar\Models\OptionTrade;
use Aaran\Sundar\Models\ShareTrades;
use Aaran\Sundar\Models\StockTrade;
use App\Livewire\Trait\CommonTrait;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OptionDetails extends Component
{
    #region[properties]
    use CommonTrait;

    public $serial;
    public $vdate;
    public $spot_name;
    public $buy = 0;
    public $sell = 0;
    public $spread = 0;
    public $shares = 0;
    public $profit = 0;
    public $loosed = 0;
    public $commission = 0;
    public $share_trade;
    public $users;

    #endregion

    #region[mount]
    public function mount($id)
    {
        $this->share_trade = ShareTrades::find($id);

        $this->users = User::all();
    }
    #endregion

    #region[save]
    public function getSave(): string
    {
        if ($this->vid == "") {
            $obj = OptionTrade::create([
                'serial' => $this->serial,
                'vdate' => $this->share_trade->vdate,
                'spot_name' => $this->spot_name,
                'buy' => $this->buy ?: 0,
                'sell' => $this->sell ?: 0,
                'spread' => $this->spread ?: 0,
                'shares' => $this->shares ?: 0,
                'profit' => $this->profit ?: 0,
                'loosed' => $this->loosed ?: 0,
                'commission' => $this->commission ?: 0,
                'share_trade_id' => $this->share_trade->id,
                'active_id' => 1,
            ]);
            $this->saveProfit();
            $message = "Saved";
        } else {
            $obj = OptionTrade::find($this->vid);
            $obj->serial = $this->serial;
            $obj->vdate = $this->vdate;
            $obj->spot_name = $this->spot_name;
            $obj->buy = $this->buy ?: 0;
            $obj->sell = $this->sell ?: 0;
            $obj->spread = $this->spread ?: 0;
            $obj->shares = $this->shares ?: 0;
            $obj->profit = $this->profit ?: 0;
            $obj->loosed = $this->loosed ?: 0;
            $obj->commission = $this->commission ?: 0;
            $obj->share_trade_id = $this->share_trade->id;
            $obj->active_id = $this->active_id;
            $obj->save();
            $this->saveProfit();
            $message = "Updated";
        }
        $this->profit = '';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        return '';
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = OptionTrade::find($id);
            $this->vid = $obj->id;
            $this->serial = $obj->serial;
            $this->vdate = $obj->vdate;
            $this->spot_name = $obj->spot_name;
            $this->buy = $obj->buy;
            $this->sell = $obj->sell;
            $this->spread = $obj->spread;
            $this->shares = $obj->shares;
            $this->profit = $obj->profit;
            $this->loosed = $obj->loosed;
            $this->commission = $obj->commission;
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

        return OptionTrade::search($this->searches)
            ->where('share_trade_id', $this->share_trade->id)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

    }
    #endregion

    #region[clearFields]
    public function clearFields(): void
    {
        $this->vid = '';
        $this->serial = '';
        $this->loosed = '';
        $this->spot_name = '';
        $this->buy = '';
        $this->sell = '';
        $this->spread = '';
        $this->shares = '';
        $this->commission = '';
        $this->active_id = '1';
    }
    #endregion

    #region[spreadCalculation]
    public function spreadCalculation()
    {
        $this->spread = round($this->sell - $this->buy, 2);
    }
    #endregion

    #region[getRoute]
    public function getRoute()
    {
        $this->redirect(route('shareTrades.options'));
    }
    #endregion

    #region[render]
    public function saveProfit()
    {
        $totalProfit = DB::table('option_trades')
            ->where('share_trade_id', $this->share_trade->id)
            ->sum('profit');

        $totalLoosed = DB::table('option_trades')
            ->where('share_trade_id', $this->share_trade->id)
            ->sum('loosed');

        $obj = ShareTrades::find($this->share_trade->id);
        $obj->option_profit = $totalProfit;
        $obj->option_loosed = $totalLoosed;
        $obj->save();

    }
    #endregion

    #region[render]
    public function render()
    {
        return view('livewire.sundar.trading.sub.option-details')->with([
            'list' => $this->getList(),
        ]);
    }
    #endregion
}