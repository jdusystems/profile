<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Asosiy</a></li>
                            <li class="breadcrumb-item"><a href="#">Talaba</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Talaba sahifasi</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">Abdullayev Alisher</h5>
                            <p class="text-muted mb-1">Full Stack Developer</p>
                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Rasmga olish</button>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Modal for capturing photo section start --}}



                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    
                                    

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Modal for capturing photo section end --}}

                <div class="col-lg-8">
                    <form action="{{ route('students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card mb-4">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Talaba ID</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mb-0 text-muted" name="student_id"
                                            value="{{ $student->student_id }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Familiyasi</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mb-0 text-muted" name="surname"
                                            value="{{ $student->surname }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Ismi</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mb-0 text-muted" name="given_name"
                                            value="{{ $student->given_name }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Telefon raqami</p>
                                    </div>
                                    <div class="col-sm-8">
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping">+998</span>
                                                <input 
                                                    type="text" 
                                                    class="form-control mb-0 text-muted" 
                                                    id="phone_number"
                                                    name="phone_number" 
                                                    value="{{ $student->phone_number }}" 
                                                    required
                                                    aria-label="Username" 
                                                    aria-describedby="addon-wrapping"
                                                    onkeydown="phoneNumberFormatter()"
                                                >
                                            </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Ota-onasining telefon raqami</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mb-0 text-muted"
                                            name="contact_number" value="{{ $student->contact_number }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-sm-4 d-flex align-items-center"></div>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary">Saqlash</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>

    <script>
        function formatPhoneNumber(value) {
            if(!value) return value;
            const phoneNumber = value.replace(/[^\d]/g, '');
            console.log(phoneNumber.length)
            const phoneNumberLength = phoneNumber.length;
            if(phoneNumberLength < 2) return phoneNumber;
            if(phoneNumberLength < 3) {
                return `${phoneNumber.slice(0,2)} ${phoneNumber.slice(2)}`;
            }
            if(phoneNumberLength < 5) {
                return `${phoneNumber.slice(0,2)} ${phoneNumber.slice(2, 5,)}`;
            }
            if(phoneNumberLength < 7) {
                return `${phoneNumber.slice(0,2)} ${phoneNumber.slice(2, 5,)}-${phoneNumber.slice(5, 7)}`;
            }
            return `${phoneNumber.slice(0,2)} ${phoneNumber.slice(2, 5,)}-${phoneNumber.slice(5, 7)}-${phoneNumber.slice(7, 9)}`;

        }
        function phoneNumberFormatter() {
            const inputField = document.getElementById('phone_number')
            const formattedInputValue = formatPhoneNumber(inputField.value)
            inputField.value = formattedInputValue;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
