{{ html()->modelForm('', 'GET', '/' . Route::current()->uri)->class('form-inline')->open() }}

    @foreach (Request::query() as $key => $value)
        @if($value != '')
            {{ html()->hidden($key)->value($value) }}
        @endif
    @endforeach

    <div class="input-daterange input-group" id="datepicker">
        {{ html()->label('Date From')->class('control-label')->for('date_from_filter') }}
        <div class="">
            {{ html()->text('date_from')->id('date_from_filter')->class('form-control')->placeholder('00-00-000')->attribute('autocomplete', 'off')->value(Request::query('date_from')) }}
        </div>
        <span class="input-group-addon"></span>
        {{ html()->label('Date To')->class('control-label')->for('date_to_filter') }}
        <div class="">
            {{ html()->text('date_to')->id('date_to_filter')->class('form-control')->placeholder('00-00-000')->attribute('autocomplete', 'off')->value(Request::query('date_to')) }}
        </div>
    </div>

    <div class="form-group">
        @php
            $managers = [];
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
    <div class="form-group">
        {{ html()->label('Client')->class('control-label')->for('client_filter') }}
        <div class="">
            {{ html()->text('client_name')->id('client_filter')->class('form-control')->placeholder('Client Name')->attribute('autocomplete', 'off')->value(Request::query('client_name')) }}
        </div>
    </div>
    <div class="form-group">
        {{ html()->label('Deposit Type')->class('control-label')->for('deposit_type_filter') }}
        <div>
            {{ html()->select('deposit_type', [
                'deposit'=>'Deposit',
                'withdraw'=>'Withdraw'
                ], Request::query('deposit_type'))->id('deposit_type_filter')->class('form-control')->placeholder('Deposit Type') }}
        </div>
    </div>
    <div class="form-group" style="margin-top: 20px;">
        {{ html()->submit('Filter')->class('btn btn-primary') }}
    </div>
{{ html()->closeModelForm() }}