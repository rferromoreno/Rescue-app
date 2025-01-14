@extends('layouts.app')

@section('title', __('actions.edit') . ' ' . $lost_person->name)

@section('content')

    <!-- Alerts - OPEN -->

        <!-- Success - OPEN -->
        @if( session()->get('success') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <div class="container text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session()->get('success') }}
              </div>
            </div>
        <!-- Success - CLOSE -->

        <!-- Error - OPEN -->
        @elseif( session()->get('error') )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <div class="container text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session()->get('error') }}
              </div>
            </div>
        @endif
        <!-- Error - CLOSE -->

    <!-- Alerts - CLOSE -->

    <!-- Content - OPEN -->
    <div class="container margin-top">

        <!-- Form - OPEN -->
        {{ Form::model($lost_person, array('action' => array('LostPersonController@update', $lost_person, 'files'=> true), 'files'=> true)) }}

            <!-- Stype service title - OPEN -->
            <div class="form-row">
                <div class="form-group col-md-auto">
                    <h3>
                        {{ $lost_person->name }}
                    </h3>
                </div>
                <div class="form-group col-md-auto">
                    <select id="found" class="form-control" name="found">
                        <option value="0" {{ ($lost_person->found === 0) ? 'selected' : '' }}>
                            {{ __('main.lost_person') }}
                        </option>
                        <option value="1" {{ ($lost_person->found === 1) ? 'selected' : '' }}>
                            {{ __('main.found') }}
                        </option>
                    </select>
                </div>
            </div>
            <!-- Stype service title - CLOSE -->

            <div class="form-row">

                <div class="form-group col-md-6">

                    <!-- User photo - OPEN -->
                    <div class="row justify-content-md-center image-upload justify-content-center">

                        <label for="photo">
                            <div class="img-container">
                                <img src="/uploads/lost_people_photos/{{ $lost_person->photo }}" class="photo mx-auto d-block rounded" id="photo_person">
                                <div class="overlay rounded photo" style="width: 300px; height: 300px; border-radius: 0; margin-top: 15px">
                                    <span class="octicon octicon-cloud-upload" style="font-size: 2rem"> </span>
                                </div>
                            </div>
                        </label>

                        <input id="photo" onchange="readURL(this);" name="photo" type="file"
                        class="form-control" style="display: none"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    </div>
                    <!-- User photo - CLOSE -->

                </div>

                <div class="form-group col-md-6">

                    <div class="form-row">

                        <!-- Name - OPEN  -->
                        <div class="form-group col-md-12">

                            <label for="name"> {{ __('register.name') }} </label>

                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" value="{{ $lost_person->name }}"/>

                            <!-- Show errors input - OPEN -->
                            @if( $errors->has('name') )
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                            <!-- Show errors input - CLOSE -->

                        </div>
                        <!-- Name - CLOSE  -->

                    </div>

                    <div class="form-row">

                        <!-- Name respond - OPEN  -->
                        <div class="form-group col-md-6">

                            <label for="name_respond"> {{ __('forms.name_respond') }} </label>

                            <input type="text" class="form-control {{ $errors->has('name_respond') ? ' is-invalid' : '' }}"
                            name="name_respond" value="{{ $lost_person->name_respond }}"/>

                            <!-- Show errors input - OPEN -->
                            @if( $errors->has('name_respond') )
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_respond') }}</strong>
                                </div>
                            @endif
                            <!-- Show errors input - CLOSE -->
                        </div>
                        <!-- Name respond - CLOSE  -->

                        <!-- Age - OPEN  -->
                        <div class="form-group col-md-6">

                            <label for="age"> {{ __('forms.age') }} </label>

                            <input type="number" class="form-control {{ $errors->has('age') ? ' is-invalid' : '' }}"
                            name="age" value="{{ $lost_person->age }}" />

                            <!-- Show errors input - OPEN -->
                            @if( $errors->has('age') )
                                <div class="invalid-feedback" role="alert">
                                    <strong> {{ $errors->first('age') }} </strong>
                                </div>
                            @endif
                            <!-- Show errors input - CLOSE -->

                        </div>
                        <!-- Age - CLOSE  -->

                        <!-- Phone - OPEN  -->
                        <div class="form-group col-md-6">

                            <label for="phone_number"> {{ __('forms.phone') }} </label>

                            <input type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                            name="phone_number" value="{{ $lost_person->phone_number }}" />

                            <!-- Show errors input - OPEN -->
                            @if( $errors->has('phone_number') )
                                <div class="invalid-feedback" role="alert">
                                    <strong> {{ $errors->first('phone_number') }} </strong>
                                </div>
                            @endif
                            <!-- Show errors input - CLOSE -->

                        </div>
                        <!-- Phone - CLOSE  -->

                        <!-- Has whatsapp or gps - OPEN  -->
                        <div class="form-group col-md-6">

                            <label for="whatsapp_or_gps"> {{ __('forms.whatsapp_or_gps') }} </label>

                            <select id="whatsapp_or_gps" class="form-control" name="whatsapp_or_gps">
                                <option value="" {{ ($lost_person->whatsapp_or_gps === '') ? 'selected' : '' }}>
                                    {{ __('forms.chose_option') }}
                                </option>
                                <option value="0" {{ ($lost_person->whatsapp_or_gps === 0) ? 'selected' : '' }}>
                                    {{ __('actions.no') }}
                                </option>
                                <option value="1" {{ ($lost_person->whatsapp_or_gps === 1) ? 'selected' : '' }}>
                                    {{ __('actions.yes') }}
                                </option>
                            </select>
                        </div>
                        <!-- Has whatsapp or gps - CLOSE  -->

                        <!-- Profile - OPEN  -->
                        <div class="form-group col-md-12">

                            <label for="profile"> {{ __('register.profile') }} </label>

                            <select id="profile" class="form-control" name="profile">
                                <option value="" {{ ($lost_person->profile === '') ? 'selected' : '' }}>
                                    {{ __('forms.chose_option') }}
                                </option>
                                <option value="Trastorn del desenvolupament"
                                {{ ($lost_person->profile === 'Trastorn del desenvolupament') ? 'selected' : '' }}>
                                    Trastorn del desenvolupament
                                </option>
                                <option value="Alzheimer o altres demencies"
                                {{ ($lost_person->profile === 'Alzheimer o altres demencies') ? 'selected' : '' }}>
                                    Alzheimer o altres demencies
                                </option>
                                <option value="Malaltia mental o psicològica"
                                {{ ($lost_person->profile === 'Malaltia mental o psicològica') ? 'selected' : '' }}>
                                    Malaltia mental o psicològica
                                </option>
                                <option value="Conductes autolítiques"
                                {{ ($lost_person->profile === 'Conductes autolítiques') ? 'selected' : '' }}>
                                    Conductes autolítiques
                                </option>
                                <option value="Excursionista o senderista"
                                {{ ($lost_person->profile === 'Excursionista o senderista') ? 'selected' : '' }}>
                                    Excursionista o senderista
                                </option>
                                <option value="Recol·lector en general"
                                {{ ($lost_person->profile === 'Recol·lector en general') ? 'selected' : '' }}>
                                    Recol·lector en general
                                </option>
                                <option value="Boletaire"
                                {{ ($lost_person->profile === 'Boletaire') ? 'selected' : '' }}>
                                    Boletaire
                                </option>
                                <option value="Cap de les anteriors"
                                {{ ($lost_person->profile === 'Cap de les anteriors') ? 'selected' : '' }}>
                                    Cap de les anteriors
                                </option>
                            </select>

                        </div>
                        <!-- Profile - CLOSE  -->

                    </div>

                </div>

            </div>

            <div class="form-row">

                <!-- Aspect description - OPEN  -->
                <div class="form-group col-md-6">
                    <label for="physical_appearance"> {{ __('forms.aspect_description') }} </label>
                    {{ Form::textarea('physical_appearance', null, array('class' => 'form-control', 'rows' => 2)) }}
                </div>
                <!--  Aspect description - CLOSE  -->

                <!-- Clothes - OPEN  -->
                <div class="form-group col-md-6">
                    <label for="clothes"> {{ __('forms.clothes') }} </label>
                    {{ Form::textarea('clothes', null, array('class' => 'form-control', 'rows' => 2)) }}
                </div>
                <!-- Clothes - CLOSE  -->

                <!-- Phisic form - OPEN  -->
                <div class="form-group col-md-6">
                    <label for="physical_condition"> {{ __('forms.phisic_form') }} </label>
                    {{ Form::textarea('physical_condition', null, array('class' => 'form-control', 'rows' => 2)) }}
                </div>
                <!-- Phisic form - CLOSE  -->

                <!-- Diseases or injuries - OPEN  -->
                <div class="form-group col-md-6">
                    <label for="diseases_or_injuries"> {{ __('forms.diseases_or_injuries') }} </label>
                    {{ Form::textarea('diseases_or_injuries', null, array('class' => 'form-control', 'rows' => 2)) }}
                </div>
                <!-- Diseases or injuries - CLOSE  -->

                <!-- Medication - OPEN  -->
                <div class="form-group col-md-6">
                    <label for="medication"> {{ __('forms.medication') }} </label>
                    {{ Form::textarea('medication', null, array('class' => 'form-control', 'rows' => 2)) }}
                </div>
                <!-- Medication - CLOSE  -->

                <!-- Limitations or discapacities - OPEN  -->
                <div class="form-group col-md-6">
                    <label for="discapacities_or_limitations"> {{ __('forms.limitations_or_discapacities') }} </label>
                    {{ Form::textarea('discapacities_or_limitations', null, array('class' => 'form-control', 'rows' => 2)) }}
                </div>
                <!-- Limitations or discapacities - CLOSE  -->

                <!-- Others - OPEN  -->
                <div class="form-group col-md-12">
                    <label for="other"> {{ __('forms.other') }} </label>
                    {{ Form::textarea('other', null, array('class' => 'form-control', 'rows' => 2)) }}
                </div>
                <!-- Others - CLOSE  -->

                <!-- Vehicle title - OPEN -->
                <div class="form-group col-md-12">
                    <h4 class="margin-top-sm" style="margin-bottom: 0">
                        {{ __('forms.vehicle') }}
                    </h4>
                </div>
                <!-- Vehicle title - CLOSE -->

                <!-- Vehicle model and brand - OPEN  -->
                <div class="form-group col-md-6">

                    <label for="model_vehicle"> {{ __('forms.model_and_brand') }} </label>

                    <input type="text" class="form-control {{ $errors->has('model_vehicle') ? ' is-invalid' : '' }}"
                    name="model_vehicle" value="{{ $lost_person->model_vehicle }}" />

                    <!-- Show errors input - OPEN -->
                    @if( $errors->has('model_vehicle') )
                        <div class="invalid-feedback" role="alert">
                            <strong> {{ $errors->first('model_vehicle') }} </strong>
                        </div>
                    @endif
                    <!-- Show errors input - CLOSE -->

                </div>
                <!-- Vehicle model and brand - CLOSE  -->

                <!-- Vehicle color - OPEN  -->
                <div class="form-group col-md-3">

                    <label for="color_vehicle"> {{ __('forms.color') }} </label>

                    <input type="text" class="form-control {{ $errors->has('color_vehicle') ? ' is-invalid' : '' }}"
                    name="color_vehicle" value="{{ $lost_person->color_vehicle }}" />

                    <!-- Show errors input - OPEN -->
                    @if( $errors->has('color_vehicle') )
                        <div class="invalid-feedback" role="alert">
                            <strong> {{ $errors->first('color_vehicle') }} </strong>
                        </div>
                    @endif
                    <!-- Show errors input - CLOSE -->

                </div>
                <!-- Vehicle color - CLOSE  -->

                <!-- Vehicle license plate - OPEN  -->
                <div class="form-group col-md-3">

                    <label for="car_plate_number"> {{ __('forms.license_plate') }} </label>

                    <input type="text" class="form-control {{ $errors->has('car_plate_number') ? ' is-invalid' : '' }}"
                    name="car_plate_number" value="{{ $lost_person->car_plate_number }}" />

                    <!-- Show errors input - OPEN -->
                    @if( $errors->has('car_plate_number') )
                        <div class="invalid-feedback" role="alert">
                            <strong> {{ $errors->first('car_plate_number') }} </strong>
                        </div>
                    @endif
                    <!-- Show errors input - CLOSE -->

                </div>
                <!-- Vehicle license plate - CLOSE  -->

            </div>
            <!-- Type activity, code and region - OPEN -->

            <!-- ID HIDDEN - OPEN -->
            <input type="hidden" class="form-control" name="id" value="{{ $lost_person->id }}">
            <!-- ID HIDDEN - CLOSE -->

            <!-- State HIDDEN - OPEN -->
            <input type="hidden" class="form-control" name="id_search" value="{{ $lost_person->id_search }}">
            <!-- State HIDDEN - CLOSE -->

            <!-- Submit button - OPEN -->
            <div class="text-center margin-top">
                <button type="submit" class="btn btn-primary">
                    {{ __('actions.save') . ' ' . __('main.lost_person') }}
                </button>
            </div>
            <!-- Submit button - OPEN -->

        {{ Form::close() }}
        <!-- Form - CLOSE -->

    </div>
    <!-- Content - CLOSE -->

@endsection

<!-- JS scripts -->
<script>

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#photo_person')
                .attr('src', e.target.result)
                .width(300)
                .height(300);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

</script>
