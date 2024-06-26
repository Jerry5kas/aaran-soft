<?php

namespace App\Livewire\Testing\TestingModule;

use Aaran\Testing\Models\Modals;
use App\Livewire\Trait\CommonTrait;
use Illuminate\Support\Str;
use Livewire\Component;

class Sub extends Component
{
    use CommonTrait;
    public $header_id;
    public $title;
    public $description;

    public function mount($id)
    {
        $this->header_id = $id;
    }

    #region[save]
    public function getSave(): void
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                $this->validate(['vname' => 'required']);
                $this->validate(['title' => 'required']);
                Modals::create([
                    'header_id' => $this->header_id,
                    'vname' => Str::ucfirst($this->vname),
                    'title' => $this->title,
                    'description' => $this->description,
                    'active_id' => $this->active_id,
                ]);
                $message = "Saved";

            } else {
                $obj = Modals::find($this->vid);
                $obj->header_id = $this->header_id;
                $obj->vname = Str::ucfirst($this->vname);
                $obj->title = $this->title;
                $obj->description = $this->description;
                $obj->active_id = $this->active_id;
                $obj->save();
                $message = "Updated";
            }

            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[obj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Modals::find($id);
            $this->vid = $obj->id;
            $this->header_id = $obj->header_id;
            $this->vname = $obj->vname;
            $this->title = $obj->title;
            $this->description = $obj->description;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[list]
    public function getList()
    {
        return Modals::search($this->searches)
            ->where('header_id', $this->header_id)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #endregion

    #region[render]
    public function reRender(): void
    {
        $this->render()->render();
    }

    public function render()
    {
        return view('livewire.testing.testing-module.sub', [
            "list" => $this->getList()
        ]);
    }
}
