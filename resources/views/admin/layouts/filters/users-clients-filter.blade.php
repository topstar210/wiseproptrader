{{ html()->modelForm('', 'GET', '/' . Route::current()->uri)->class('form-inline')->open() }}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {{ html()->label('Client Name')->class('control-label')->for('client_filter') }}
                <div class="">
                    {{ html()->text('client_name')->id('client_filter')->class('form-control')->placeholder('Client Name')->attribute('autocomplete', 'off')->value(Request::query('client_name')) }}
                </div>
            </div>
            <div class="form-group" style="margin-top: 20px;">
                {{ html()->submit('Search')->class('btn btn-primary') }}
            </div>
        </div>
        <div class="col-md-9">
            @foreach (Request::query() as $key => $value)
                @if($value != '')
                    {{ html()->hidden($key)->value($value) }}
                @endif
            @endforeach
            <div class="form-group">
                @php
                    $managers = ['-1' => 'Empty'];
                    $managers_query = DB::table('users')->whereIn('role', [1, 2, 3])->get();
                    foreach ($managers_query as $key => $value) {
                        $managers[$value->id] = $value->name;
                    }
                @endphp
                {{ html()->label('Manager')->class('control-label')->for('manager_filter') }}
                <div class="">
                    {{ html()->select('manager', $managers, Request::query('manager'))->id('manager_filter')->class('form-control')->placeholder('Manager') }}
                </div>
            </div>
            <div class="form-group" style="margin-top: 20px;">
                {{ html()->submit('Filter')->class('btn btn-primary') }}
            </div>
        </div>
    </div>
{{ html()->closeModelForm() }}