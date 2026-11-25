@if($errors->any())<div class="error"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<label>Title<input name="title" value="{{ old('title',$task->title ?? '') }}" required maxlength="120"></label>
<label>Description<textarea name="description" required maxlength="2000">{{ old('description',$task->description ?? '') }}</textarea></label>
<label>Due date<input type="date" name="due_date" value="{{ old('due_date',isset($task) ? $task->due_date->format('Y-m-d') : '') }}" required></label>
<label>Status<select name="status" required>@foreach(['pending'=>'Pending','in_progress'=>'In progress','done'=>'Done'] as $value=>$label)<option value="{{ $value }}" @selected(old('status',$task->status ?? 'pending')===$value)>{{ $label }}</option>@endforeach</select></label>
<button class="button">Save task</button>
