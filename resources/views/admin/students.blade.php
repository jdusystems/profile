@extends('admin.master')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35">Talabalar ro'yxati</h3>
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="rs-select2--light rs-select2--md">
                        <select class="js-select2" name="property">
                            <option selected="selected">Xususiyatlar</option>
                            <option value="">Option 1</option>
                            <option value="">Option 2</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="rs-select2--light rs-select2--sm">
                        <select class="js-select2" name="time">
                            <option selected="selected">Bugun</option>
                            <option value="">3 kun</option>
                            <option value="">Shu hafta</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <button class="au-btn-filter">
                        <i class="zmdi zmdi-filter-list"></i>filter</button>
                </div>
                <div class="table-data__tool-right">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>Talaba qo'shish</button>
                    <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                        <select class="js-select2" name="type">
                            <option selected="selected">Eksport</option>
                            <option value="">Option 1</option>
                            <option value="">Option 2</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </th>
                            <th>talaba id</th>
                            <th>Ism familiyasi</th>
                            <th>Talaba telefon raqami</th>
                            <th>Ota-ona telefon raqami</th>
                            <th>Holati</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($students))
                            @foreach ($students as $student)
                                <tr class="tr-shadow">
                                    <td>
                                        <label class="au-checkbox">
                                            <input type="checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="desc">{{ $student->student_id }}</td>
                                    <td>{{ $student->given_name . ' ' . $student->surname }}</td>
                                    <td>
                                        @if ($student->phone_number)
                                            {{ $student->phone_number }}
                                        @else
                                            ---
                                        @endif
                                    </td>
                                    <td>
                                        @if ($student->contact_number)
                                            {{ $student->contact_number }}
                                        @else
                                            ---
                                        @endif
                                    </td>
                                    <td>
                                        @if ($student->phone_number && $student->contact_number)
                                            <span class="status--process">Tasdiqlangan</span>
                                        @else
                                            <span class="status--denied">Tasdiqlanmagan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Send">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        @else
                            <tr class="tr-shadow">
                                <td colspan="6">Ma'lumot yo'q</td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection
