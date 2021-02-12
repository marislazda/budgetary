@extends('html')

@section('content')
    <div id="container">
        <div id="store-form">
            <form method="post" action="{{ route('form.submit') }}">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="product" class="col-sm-3 col-form-label">
                        Produkts
                    </label>
                    <div class="col-sm-9">
                        <input name="product" type="text" class="form-control" id="product" placeholder="Produkts">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type_id" class="col-sm-3 col-form-label">
                        Kategorija
                    </label>
                    <div class="col-sm-9">
                        {!! Form::select('type_id', $types, 9, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-3 col-form-label">Cena</label>
                    <div class="col-sm-9">
                        <input name="price" type="text" pattern="^\d*(\.\d{0,2})?$" class="form-control" id="price" placeholder="Cena">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-3 col-sm-9">
                        <button type="submit" class="btn btn-primary">Pievienot</button>
                    </div>
                </div>
            </form>

            <div id="store-form-import">
                <a href="{{ route('importForm') }}" class="submit-button">Importēt</a>
            </div>
        </div>
    </div>
@stop
