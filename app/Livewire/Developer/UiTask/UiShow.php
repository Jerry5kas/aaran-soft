<?php

namespace App\Livewire\Developer\UiTask;

use Aaran\Developer\Models\UiReply;
use Aaran\Developer\Models\UiTask;
use App\Enums\Active;
use App\Enums\Status;
use App\Livewire\Trait\CommonTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UiShow extends Component
{
    use CommonTrait;
    use WithFileUploads;

    #region[Properties]
    public $ui_task_id;
    public string $body;
    public string $allocated;
    public string $status;
    public string $priority;
    public $verify;
    public $ui_pic;
    public int $actives;
    public $updated_at;
    public $ui_replies;
    public $ui_reply_id;
    public $commentsCount;
    public string $ui_reply;
    public $verified;
    public $verified_on;
    public string $user_id;
    public $showEditModal_1 = false;
    public string $changeStatus = '';
    public $image;
    public $old_image;

    public $route;
    #endregion


    #region[Mount]
    public function mount($id): void
    {
        $this->route = url()->previous();
        $this->getData($id);

        $this->ui_replies = UiReply::where('ui_task_id', $id)->get();
        $this->commentsCount = UiReply::where('ui_task_id', $id)->count();
    }
    #endregion

    #region[Save]
    public function getSave(): string
    {
        $this->validate([
            'ui_reply' => 'required',
        ]);

        if ($this->ui_reply != '') {
            if ($this->vid == "") {

                $obj = UiReply::create([
                    'ui_task_id' => $this->ui_task_id,
                    'vname' => $this->ui_reply,
                    'verified' => $this->verified,
                    'verified_on' => $this->verified_on,
                    'user_id' => Auth::user()->id,
                    'image' => $this->saveImage()
                ]);
            } else {
                $reply = UiReply::find($this->vid);
                $reply->vname = $this->vname;
                $reply->verified = $this->verified;
                $reply->verified_on = $this->verified_on;
                $reply->image = $this->saveImage();

                if ($reply->user_id == auth()->id()) {
                    $reply->save();
                }
            }
        }
        redirect()->to(route('ui-task.show', [$this->ui_task_id]));
        $this->clearFields();
        return '';
    }
    #endregion

    #region[Obj]
    public function getData($id)
    {
        if ($id) {

            $obj = UiTask::find($id);

            $this->ui_task_id = $obj->id;
            $this->vname = $obj->vname;
            $this->body = $obj->body;
            $this->allocated = $obj->allocated;
            $this->status = $obj->status;
            $this->priority = $obj->priority;
            $this->verify = $obj->verify;
            $this->actives = $obj->actives ? 0 : 1;
            $this->ui_pic = $obj->ui_pic;
            $this->updated_at = $obj->updated_at;
            return $obj;
        }
        return null;
    }

    #endregion

    public function getObj($id)
    {
        if ($id) {
            $obj = UiReply::find($id);

            $this->ui_reply_id = $obj->id;
            $this->vname = $obj->vname;
            $this->verified = $obj->verified;
            $this->verified_on = $obj->verified_on;
            $this->old_image = $obj->image;
        }
        return $obj;
    }

    #region[ClearFields]
    public function clearFields()
    {
        $this->ui_reply = '';
        $this->verified_on = '';
        $this->verified = '';
        $this->image = '';
        $this->old_image = '';

    }
    #endregion

    #region[Status]
    public function updateStatus(): void
    {
        $this->validate(['changeStatus' => 'required']);
        $obj = UiTask::find($this->ui_task_id);
        $obj->status = $this->changeStatus;
        $obj->save();
        redirect()->to(route('ui-task.show', [$this->ui_task_id]));
    }

    public function adminCloseTask(): void
    {
        $obj = UiTask::find($this->ui_task_id);
        $obj->status = Status::ADMINCLOSED->value;
        $obj->active_id = Active::NOTACTIVE->value;
        $obj->save();
        redirect()->to(route('ui_tasks'));
    }
    #endregion

    #region[Image]
    public function saveImage()
    {
        if ($this->image) {

            $image = $this->image;
            $filename = $this->image->getClientOriginalName();

            if (Storage::disk('public')->exists(Storage::path('public/images/' . $this->old_image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' . $this->old_image));
            }
            $image->storeAs('public/images', $filename);
            return $filename;

        } else {
            if ($this->old_image) {
                return $this->old_image;
            } else {

                return $this->image = 'empty';
            }
        }
    }



#endregion

#region[FullView]
    public
        $full_image;

    public
    function fullView($id)
    {
        $this->showEditModal_1 = true;
        $data = UiReply::find($id);
        $this->full_image = $data->image;

    }

    public
    function fullImage()
    {
        $this->showEditModal_1 = true;
        $this->full_image = $this->ui_pic;
    }

#endregion

#region[Route]
    public
    function getRoute(): void
    {
        $this->redirect($this->route);
    }

#endregion

#region[Render]
    public function reRender(): void
    {
        $this->render();
    }


    public function render()
    {
        return view('livewire.developer.ui-task.ui-show');
    }
#endregion
}