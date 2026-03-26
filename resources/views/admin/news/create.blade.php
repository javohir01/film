@extends('admin.layouts.admin')

@section('title', 'Yangililar qo\'shish')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yangiliklar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">News</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-11 mr-auto ml-auto">

            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{ session()->get('error') }}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ── Til tanlash (faqat shu qo'shildi) ── --}}
                        <div class="form-group col-md-1 pl-0">
                            <select name="locale" id="locale-select" class="form-control">
                                <option value="oz" {{ old('locale') == 'oz' ? 'selected' : '' }}>O'Z</option>
                                <option value="uz" {{ old('locale') == 'uz' ? 'selected' : '' }}>UZ</option>
                                <option value="ru" {{ old('locale') == 'ru' ? 'selected' : '' }}>RU</option>
                                <option value="en" {{ old('locale') == 'en' ? 'selected' : '' }}>EN</option>
                            </select>
                        </div>

                        <hr>

                        {{-- ── Qolgan forma o'zgarmagan ── --}}
                        <div class="form-group">
                            <label for="category_id">Yangiliklar kategoriyasi</label>
                            <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') border-danger @enderror">
                                <option>----</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_oz }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('category_id') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="name">Nomi</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') border-danger @enderror"
                                   placeholder="Nomi" value="{{ old('name') }}">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="image">Rasm</label>
                            <input type="file" name="images" id="image"
                                   class="form-control @error('images') border-danger @enderror"
                                   accept="image/jpeg,image/png,image/jpg">
                            <small class="text-danger">{{ $errors->first('images') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Qisqacha ma'lumot</label>
                            <textarea name="description" rows="5" id="description"
                                      class="form-control @error('description') border-danger @enderror"
                                      placeholder="Qisqacha ma'lumot">{{ old('description') }}</textarea>
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="content">To'liq ma'lumot</label>
                            <textarea name="content"
                                      class="textarea form-control summernote @error('content') border-danger @enderror"
                                      id="summernote" placeholder="To'liq ma'lumot">{{ old('content') }}</textarea>
                            <small class="text-danger">{{ $errors->first('content') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control form-control-sm" id="status">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>No Active</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <label for="telegram">
                                <input type="checkbox" class="form-check-input" id="telegram"
                                       name="telegram_status" value="true"
                                    {{ old('telegram_status') ? 'checked' : '' }}>
                                <span class="telegram-label">Telegramga Yuborish</span>
                            </label>
                        </div>

                        <div class="text-right mt-3">
                            <button class="btn btn-success">&check; Saqlash</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        const localeTexts = {
            oz: {
                name:        { label: "Nomi",               placeholder: "Nomi" },
                description: { label: "Qisqacha ma'lumot",  placeholder: "Qisqacha ma'lumot" },
                content:     { label: "To'liq ma'lumot",    placeholder: "To'liq ma'lumot" },
                category:    { label: "Yangiliklar kategoriyasi" },
                status:      { label: "Status" },
                telegram:    { label: "Telegramga Yuborish" },
                image:       { label: "Rasm" },
            },
            uz: {
                name:        { label: "Номи",               placeholder: "Номи" },
                description: { label: "Қисқача маълумот",   placeholder: "Қисқача маълумот" },
                content:     { label: "Тўлиқ маълумот",     placeholder: "Тўлиқ маълумот" },
                category:    { label: "Янгиликлар категорияси" },
                status:      { label: "Статус" },
                telegram:    { label: "Телеграмга Юбориш" },
                image:       { label: "Расм" },
            },
            ru: {
                name:        { label: "Имя",                placeholder: "Имя" },
                description: { label: "Краткая информация", placeholder: "Краткая информация" },
                content:     { label: "Полная информация",  placeholder: "Полная информация" },
                category:    { label: "Категория новостей" },
                status:      { label: "Статус" },
                telegram:    { label: "Отправить в Telegram" },
                image:       { label: "Изображение" },
            },
            en: {
                name:        { label: "Name",                placeholder: "Имя" },
                description: { label: "Description", placeholder: "Brief information" },
                content:     { label: "Content",  placeholder: "Full information" },
                category:    { label: "News category" },
                status:      { label: "Status" },
                telegram:    { label: "Send to Telegram" },
                image:       { label: "Images" },
            },
        };

        function updateForm(locale) {
            const t = localeTexts[locale];

            // Label va placeholder yangilash
            document.querySelector('label[for="name"]').textContent           = t.name.label;
            document.querySelector('input[name="name"]').placeholder          = t.name.placeholder;

            document.querySelector('label[for="description"]').textContent    = t.description.label;
            document.querySelector('textarea[name="description"]').placeholder = t.description.placeholder;

            document.querySelector('label[for="content"]').textContent        = t.content.label;

            document.querySelector('label[for="category_id"]').textContent    = t.category.label;
            document.querySelector('label[for="status"]').textContent         = t.status.label;
            document.querySelector('label[for="image"]').textContent          = t.image.label;
            document.querySelector('.telegram-label').textContent             = t.telegram.label;
        }

        document.getElementById('locale-select').addEventListener('change', function () {
            updateForm(this.value);
        });

        // Sahifa yuklanganda ham ishlaydi
        updateForm(document.getElementById('locale-select').value);
    </script>
@endpush
