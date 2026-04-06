@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Afarizm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('aphorism.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Aphorism</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger" id="close">
                    {{session()->get('error')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-info card-outline">
                <div class="card-body">
                    <form action="{{route('aphorism.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                                <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                                <div class="form-group">
                                    <label>{{labels('f.i.o')}}</label>
                                    <input type="text" class="form-control @error('full_name') border-danger @enderror" name="full_name" value="{{$model->translations->first()?->full_name}}">
                                    <small class="text-danger">{{$errors->first('full_name')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>{{labels('image')}}</label>
                                    <input type="file" class="form-control @error('images') border-danger @enderror" name="image"
                                           accept="image/jpeg, image/jpg, image/png, image/gif">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>


                                <div class="form-group">
                                    <label>{{labels('description')}}</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control @error('description') border-danger @enderror">{{$model->translations->first()?->description}}</textarea>
                                    <small class="text-danger">{{$errors->first('description')}}</small>
                                </div>

                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <label>{{labels('calendar')}}</label>
                                    </div>
                                    <div class="card-body">
                                        <div id="dynamic-forms">
                                            @php
                                                $translation = $model->translations->first();
                                                $calendars = $translation?->calendar ?? [];
                                            @endphp
                                            @foreach($calendars as $k => $value)
                                                <div class="card mb-2 dynamic-form">
                                                    <div class="card-header">
                                                        <label>{{ $k + 1 }}</label>
                                                        <button type="button" class="remove-form-btn btn btn-danger btn-sm float-right">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                    <textarea name="calendar[{{ $k }}]"
                                                      class="form-control @error("calendar.$k") border-danger @enderror"
                                                      placeholder="Enter description">
                                                        {{ $value }}
                                                    </textarea>
                                                            <small class="text-danger">{{ $errors->first("calendar.$k") }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- First Form -->
                                            <button type="button" class="btn btn-primary mt-3 float-right" id="add-form-btn">
                                                + Qo'shish
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">{{labels('status')}}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                        <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>{{labels('order')}}</label>
                                    <input type="text" name="order" class="form-control" value="{{$model->order}}">
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-success">&check;Saqlash</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
{{--    <script>--}}
{{--        let formIndexes = 1; // Track form indexes for both sections--}}
{{--        function addForm(section) {--}}
{{--            const dynamicForms = document.getElementById(`dynamic-forms_${section}`);--}}
{{--            let formIndex = formIndexes[section];--}}
{{--            console.log(formIndex)--}}
{{--            // Create a new form group--}}
{{--            const newForm = document.createElement('div');--}}
{{--            newForm.classList.add('form-group', 'dynamic-form', 'mt-3');--}}
{{--            newForm.innerHTML = `--}}
{{--                <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <label>${formIndex}</label>--}}
{{--                                <button type="button" class="remove-form-btn btn btn-danger float-right"><i class="fas fa-trash"></i></button>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <label>Forma ${formIndex}</label>--}}
{{--                                <textarea name="calendar[${formIndex}][description_${section}]" class="form-control" placeholder="Enter description"></textarea>--}}
{{--                            </div>--}}
{{--                </div>--}}
{{--        `;--}}

{{--            // Append the new form group before the add button--}}
{{--            const addFormButton = document.getElementById(`add-form-btn_${section}`);--}}
{{--            addFormButton.parentNode.insertBefore(newForm, addFormButton);--}}

{{--            // Increment form index--}}
{{--            formIndexes[section]++;--}}
{{--        }--}}

{{--        function reindexForms(section) {--}}
{{--            const forms = document.querySelectorAll(`#dynamic-forms_${section} .dynamic-form`);--}}
{{--            forms.forEach((form, index) => {--}}
{{--                // Update the `name` attributes for each input and textarea--}}
{{--                const descriptionTextarea = form.querySelector(`textarea[name^="calendar"]`);--}}
{{--                if (descriptionTextarea) {--}}
{{--                    descriptionTextarea.setAttribute('name', `calendar[${index + 1}][description_${section}]`);--}}
{{--                }--}}

{{--                // Update label text--}}
{{--                const label = form.querySelector('label');--}}
{{--                if (label) {--}}
{{--                    label.textContent = `Form ${index + 1}`;--}}
{{--                }--}}
{{--            });--}}

{{--            // Update the form index tracker--}}
{{--            formIndexes[section] = forms.length + 1;--}}
{{--        }--}}

{{--        function check(section) {--}}
{{--            let isValid = true;--}}
{{--            $(`#dynamic-forms_${section} .dynamic-form`).each(function (){--}}
{{--                let textarea = $(this).find('textarea');--}}
{{--                // let add = document.getElementsByName(`calendar[${index + 1}][description_${section}]`);--}}
{{--                if (textarea.val().trim() === '') {--}}
{{--                    textarea.addClass('border-danger');--}}
{{--                    isValid = false;--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        // Add event listeners for adding forms--}}
{{--        ['oz', 'uz'].forEach((section) => {--}}
{{--            document.getElementById(`add-form-btn_${section}`).addEventListener('click', () => addForm(section));--}}
{{--            document.getElementById(`add-form-btn_${section}`).addEventListener('click', () => check(section));--}}

{{--            // Delegate click event for remove buttons--}}
{{--            document.getElementById(`dynamic-forms_${section}`).addEventListener('click', (e) => {--}}
{{--                if (e.target.classList.contains('remove-form-btn')) {--}}
{{--                    const formGroup = e.target.closest('.dynamic-form')--}}
{{--                    if (formGroup){--}}
{{--                        formGroup.remove()--}}
{{--                        reindexForms(section); // Reindex forms after one is removed--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
<script>
    let formIndex = {{ count($translation?->calendar ?? []) }};
    console.log(formIndex);
    function addForm() {
        const dynamicForms = document.getElementById('dynamic-forms');
        const addFormButton = document.getElementById('add-form-btn');
        console.log(addFormButton);
        const newForm = document.createElement('div');
        newForm.classList.add('dynamic-form');
        newForm.innerHTML = `
        <div class="card mb-2">
            <div class="card-header">
                <label>${formIndex + 1}</label>
                <button type="button" class="remove-form-btn btn btn-danger btn-sm float-right">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="card-body">
                <textarea name="calendar[${formIndex}]"
                          class="form-control"
                          placeholder="Enter description"></textarea>
            </div>
        </div>
    `;

        dynamicForms.insertBefore(newForm, addFormButton);
        formIndex++;
    }

    function reindexForms() {
        const forms = document.querySelectorAll('#dynamic-forms .dynamic-form');
        forms.forEach((form, index) => {
            const textarea = form.querySelector('textarea');
            if (textarea) {
                textarea.setAttribute('name', `calendar[${index}]`);
            }
            const label = form.querySelector('.card-header label');
            if (label) {
                label.textContent = index + 1;
            }
        });
        formIndex = forms.length;
    }

    document.getElementById('add-form-btn').addEventListener('click', addForm);

    document.getElementById('dynamic-forms').addEventListener('click', function (e) {
        const removeBtn = e.target.closest('.remove-form-btn');
        if (removeBtn) {
            const formGroup = removeBtn.closest('.dynamic-form');
            if (formGroup) {
                formGroup.remove();
                reindexForms();
            }
        }
    });
</script>
@endpush
