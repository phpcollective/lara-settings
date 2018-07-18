@extends('vendor.phpcollective.settings.layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Setting</div>
                    <div class="card-body">
                        <br/>
                        <br/>

                        {{--@if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif--}}

                        {!! Form::open(['route' => 'setting.update', 'class' => 'form-horizontal', 'files' => false]) !!}

                        <table id="table-setting" class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 30%;">Key</th>
                                <th style="width: 60%;">Value</th>
                                <th style="width: 10%;">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($settings) > 0)
                                @foreach($settings as $setting)
                                    <tr>
                                        <td>{!! Form::text('key[]', $setting->key, ['class' => 'form-control', 'required' => 'required']) !!}</td>
                                        <td>{!! Form::text('value[]', $setting->value, ['class' => 'form-control', 'required' => 'required']) !!}</td>
                                        <td>
                                            {{ Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>',[
                                                'class'=>'btn btn-xs btn-danger removeRowBtn',
                                                'data-toggle'=>'tooltip',
                                                'data-placement'=>'top',
                                                'title'=>'Delete'
                                            ])}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    {{ Form::button('<i class="fas fa-plus-square" aria-hidden="true"></i>',[
                                        'class'=>'btn btn-xs btn-success',
                                        'id'=>'addRowBtn',
                                        'data-toggle'=>'tooltip',
                                        'data-placement'=>'top',
                                        'title'=>'Add'
                                    ])}}
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
@endpush
@push('scripts')
    <script>
        $(function () {
            $('#addRowBtn').on('click', function () {
                var newRow = '<tr>' +
                    '<td><input class="form-control" required="required" name="key[]" type="text" value=""></td>' +
                    '<td><input class="form-control" required="required" name="value[]" type="text" value=""></td>' +
                    '<td><button class="btn btn-xs btn-danger removeRowBtn" data-toggle="tooltip" data-placement="top" title="Delete" type="button"><i class="fas fa-trash-alt" aria-hidden="true"></i></button></td>' +
                    '</tr>';

                $('#table-setting tbody').append(newRow);
            });

            $(document).on('click', '.removeRowBtn', function () {
                var btn = $(this);
                keyName = btn.closest("tr").find("input[name='key[]']").val();
                if (keyName != '') {
                    if (confirm('Confirm delete "' + keyName + '"?')) {
                        btn.closest('tr').remove();
                    }
                } else {
                    btn.closest('tr').remove();
                }
            });
        })
    </script>
@endpush
