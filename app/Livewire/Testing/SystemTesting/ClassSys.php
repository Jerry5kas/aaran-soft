<?php

namespace App\Livewire\Testing\SystemTesting;

use Aaran\Testing\Models\AdminTest;
use Aaran\Testing\Models\DbTest;
use Aaran\Testing\Models\LwClassTest;
use App\Livewire\Trait\CommonTrait;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ClassSys extends Component
{
    use CommonTrait;

    #region[properties]
    public mixed $admin;
    public mixed $admin_id;
    public mixed $module_id;
    public mixed $class_file;

    public mixed $description = '';
    public bool $checked_1 = false;
    public bool $checked_2 = false;
    public bool $checked_3 = false;
    public bool $checked_4 = false;
    public bool $checked_5 = false;
    public bool $checked_6 = false;
    public bool $checked_7 = false;
    public bool $checked_8 = false;
    public mixed $comment = '';

    public  mixed $users = '';
    public string $sortFields = 'created_at';

    public bool $showEditModal = false;
    public mixed $editable = true;
    public $backToDataBase;
    public $previous;

    #endregion

    #region[mount]


    public function mount($id)
    {
        $this->admin = AdminTest::find($id);
        $this->module_id = $this->admin->module_id;
        $this->previous=$this->admin->db_id;
        $this->backToDataBase=DbTest::find($this->previous)->model_id;
        $this->admin_id = $id;
        $this->users=User::all();
    }
    #endregion

    #region[getSave]
    public function getSave()
    {
        if ($this->editable) {
            if ($this->vname != '') {
                if ($this->vid == "") {
                    LwClassTest::create([
                        'module_id' => $this->module_id,
                        'admin_id' => $this->admin_id,
                        'vname' => Str::ucfirst($this->vname),
                        'class_file' => Str::ucfirst($this->class_file),
                        'description' => Str::ucfirst($this->description),
                        'checked_1' => $this->checked_1?:0,
                        'checked_2' => $this->checked_2?:0,
                        'checked_3' => $this->checked_3?:0,
                        'checked_4' => $this->checked_4?:0,
                        'checked_5' => $this->checked_5?:0,
                        'checked_6' => $this->checked_6?:0,
                        'checked_7' => $this->checked_7?:0,
                        'checked_8' => $this->checked_8?:0,
                        'comment' => Str::ucfirst($this->comment),
                        'user_id' => Auth::user()->id,
                        'active_id' => 1,
                    ]);
                    $message = 'Saved';
                }
                else {
                    $obj = LwClassTest::find($this->vid);
                    $obj->vname = Str::ucfirst($this->vname);
                    $obj->class_file = Str::ucfirst($this->class_file);
                    $obj->description = Str::ucfirst($this->description);
                    $obj->checked_1 = $this->checked_1;
                    $obj->checked_2 = $this->checked_2;
                    $obj->checked_3 = $this->checked_3;
                    $obj->checked_4 = $this->checked_4;
                    $obj->checked_5 = $this->checked_5;
                    $obj->checked_6 = $this->checked_6;
                    $obj->checked_7 = $this->checked_7;
                    $obj->checked_8 = $this->checked_8;
                    $obj->comment = Str::ucfirst($this->comment);
                    $obj->active_id = $this->active_id;
                    $obj->save();
                    $message = "Updated";
                }
                $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
                $this->clearFields();
                $this->render();
            }
        }
    }
    #endregion




    #region[obj]
    public function getObj($id)
    {
        if ($id) {
            $obj = LwClassTest::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->class_file = $obj->class_file;
            $this->description = $obj->description;
            $this->checked_1 = $obj->checked_1;
            $this->checked_2 = $obj->checked_2;
            $this->checked_3 = $obj->checked_3;
            $this->checked_4 = $obj->checked_4;
            $this->checked_5 = $obj->checked_5;
            $this->checked_6 = $obj->checked_6;
            $this->checked_7 = $obj->checked_7;
            $this->checked_8 = $obj->checked_8;
            $this->comment = $obj->comment;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion


    #region[clearFields]
    public function clearFields()
    {
        $this->vid = '';
        $this->vname = '';
        $this->class_file = '';
        $this->description = '';
        $this->checked_1 = '';
        $this->checked_2 = '';
        $this->checked_3 = '';
        $this->checked_4 = '';
        $this->checked_5 = '';
        $this->checked_6 = '';
        $this->checked_7 = '';
        $this->checked_8 = '';
        $this->comment = '';
        $this->active_id = 1;
    }
    #endregion

    #region[checked]
    public function isChecked1($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_1 = !$check_1->checked_1;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    public function isChecked2($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_2 = !$check_1->checked_2;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    public function isChecked3($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_3 = !$check_1->checked_3;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    public function isChecked4($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_4 = !$check_1->checked_4;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    public function isChecked5($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_5 = !$check_1->checked_5;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    public function isChecked6($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_6 = !$check_1->checked_6;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    public function isChecked7($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_7 = !$check_1->checked_7;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    #endregion

    public function isChecked8($id): void
    {
        $check_1 = LwClassTest::find($id);
        $check_1->checked_8 = !$check_1->checked_8;
        $check_1->save();
        $this->clearFields();
        $this->dispatch('$refresh');
    }
    #endregion


    public function sortBy($field): void
    {
        if ($this->sortFields === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortFields = $field;
    }


    #region[list]
    public function getList()
    {
        return LwClassTest::search($this->searches)
            ->where('module_id','=',$this->module_id)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortFields, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[render]
    public function reRender(): void
    {
        $this->render()->render();
    }

    public function render()
    {
        return view('livewire.testing.system-testing.class-sys')->with([
            "list" => $this->getList()
        ]);
    }
    #endregion
}
