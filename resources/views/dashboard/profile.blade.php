<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JDU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #video-container {
            max-width: 100%;
            margin: 20px auto;
        }

        #captured-photo {
            max-width: 100%;
            height: auto;
            display: none;
        }
    </style>
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
                            <img src="{{ asset($photo_url) }}" id="user_avatar" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ $student->given_name . ' ' . $student->surname }}</h5>
                            <p class="text-muted mb-1">Talaba</p>
                            <p class="text-muted mb-4">Japan Digital University</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalForCapturing">Rasmga olish</button>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- Modal for capturing photo section start --}}
                <div class="modal modal-lg fade" id="modalForCapturing" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Talabani suratga olish</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div id="video-container"
                                        class="d-flex align-items-center justify-content-center flex-column gap">
                                        <video id="video" autoplay playsinline width="100%"></video>
                                        <button type="button" onclick="capturePhoto()"
                                            class="btn btn-warning mt-4">Capture
                                            Photo</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal for capturing photo section end --}}

                <div class="col-lg-8">
                    <form action="{{ route('students.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card mb-4">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Talaba ID</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" id="student_id" class="form-control mb-0 text-muted"
                                            name="student_id" value="{{ $student->student_id }}">
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
                                    <div class="col-sm-8 col-md-5">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping">+998</span>
                                            <input type="text" class="form-control mb-0 text-muted"
                                                id="phone_number" name="phone_number"
                                                value="{{ Str::substr($student->phone_number, 3, 9) }}" required
                                                aria-label="Username" aria-describedby="addon-wrapping"
                                                onkeyup="phoneNumberFormatter()">
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-12 col-md-3 d-flex align-items-center justify-content-center justify-content-sm-end">
                                        <button type="button" id="sendSmsPhoneNumberButton"
                                            class="btn btn-sm btn-primary">SMS
                                            jo'natish</button>
                                    </div>
                                </div>
                                <div class="row mt-2 d-none" id="phoneNumberSmsConfirmationSection">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Jo'natilgan sms ni kiriting</p>
                                    </div>
                                    <div class="col-sm-4 col-md-5">
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control form-control-sm mb-0 text-muted"
                                                id="phoneNumberConfirmationInput">
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-4 col-md-3  d-flex align-items-center justify-content-center justify-content-sm-end">
                                        <button type="button" class="btn btn-sm btn-primary"
                                            data-phone="phone_number" data-sms="phoneNumberConfirmationInput"
                                            onclick="confirmSms()">Tasdiqlash</button>
                                    </div>
                                </div>

                                <hr>

                                <div class="row align-items-center">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Ota-onasining telefon raqami</p>
                                    </div>
                                    <div class="col-sm-8 col-md-5">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping">+998</span>
                                            <input type="text" class="form-control mb-0 text-muted"
                                                id="contact_number" name="contact_number"
                                                value="{{ Str::substr($student->contact_number, 3, 9) }}"
                                                onkeyup="phoneNumberFormatter()">
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-12 col-md-3 d-flex align-items-center justify-content-center justify-content-sm-end">
                                        <button type="button" id="sendSmsContactNumberButton"
                                            class="btn btn-sm btn-primary">SMS
                                            jo'natish</button>
                                    </div>
                                </div>
                                <div class="row mt-2 d-none" id="contactNumberSmsConfirmationSection">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <p class="mb-0">Jo'natilgan sms ni kiriting</p>
                                    </div>
                                    <div class="col-sm-4 col-md-5">
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control form-control-sm mb-0 text-muted"
                                                id="contactNumberConfirmationInput">
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-4 col-md-3  d-flex align-items-center justify-content-center justify-content-sm-end">
                                        <button type="button" class="btn btn-sm btn-primary"
                                            data-phone="contact_number" data-sms="contactNumberConfirmationInput"
                                            onclick="confirmSms()">Tasdiqlash</button>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script defer>
        // Global variables
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const video = document.getElementById('video');
        const capturedPhoto = document.getElementById('captured-photo');
        const uploadInput = document.getElementById('upload-input');
        const userAvatar = document.getElementById('user_avatar');
        const studentImage = document.getElementById('student_image');
        const studentId = document.getElementById('student_id');

        const phoneNumber = document.getElementById('phone_number');
        const sendSmsPhoneNumberButton = document.getElementById('sendSmsPhoneNumberButton');
        const phoneNumberSmsConfirmationSection = document.getElementById('phoneNumberSmsConfirmationSection');
        const phoneNumberConfirmationInput = document.getElementById('phoneNumberConfirmationInput');

        const contactNumber = document.getElementById('contact_number');
        const sendSmsContactNumberButton = document.getElementById('sendSmsContactNumberButton');
        const contactNumberSmsConfirmationSection = document.getElementById('contactNumberSmsConfirmationSection');
        const contactNumberConfirmationInput = document.getElementById('contactNumberConfirmationInput');

        document.addEventListener('DOMContentLoaded', function() {
            // Get all input elements
            var inputElements = document.querySelectorAll('input');

            // Add event listener to each input element
            inputElements.forEach(function(inputElement) {
                inputElement.addEventListener('keypress', function(event) {
                    // Check if the pressed key is Enter (key code 13)
                    if (event.key === 'Enter') {
                        event.preventDefault();
                    }
                });
            });
        });
        // Toasts for notifications
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        // SMS CONFIRMATION SECTION STARTS HERE
        sendSmsPhoneNumberButton.addEventListener('click', function(event) {
            const filteredPhoneNumber = "998" + phoneNumber.value.replace(/[^\d]/g, '');
            fetch('/sendSms', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        phone_number: filteredPhoneNumber
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    Toast.fire({
                        icon: "success",
                        title: data.message
                    });
                    phoneNumberSmsConfirmationSection.classList.remove('d-none');
                    phoneNumberConfirmationInput.focus();
                })
                .catch((error) => {
                    console.error('Error sending sms to server:', error);
                    Toast.fire({
                        icon: "error",
                        title: "Tasdiqlash kodi noto'g'ri"
                    });
                });

        })
        sendSmsContactNumberButton.addEventListener('click', function(event) {
            const filteredContactNumber = "998" + contactNumber.value.replace(/[^\d]/g, '');
            fetch('/sendSms', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        phone_number: filteredContactNumber
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    contactNumberSmsConfirmationSection.classList.remove('d-none');
                    contactNumberConfirmationInput.focus();
                })
                .catch((error) => {
                    console.error('Error sending sms to server:', error);
                    Toast.fire({
                        icon: "error",
                        title: "Tasdiqlash kodi noto'g'ri"
                    });
                    
                });

        })
        // SMS CONFIRMATION SECTION ENDS HERE

        // CAMERA CAPTURING SECTION START

        const myModal = new bootstrap.Modal(document.getElementById('modalForCapturing'));

        let stream;

        const constraints = {
            video: {
                facingMode: 'user'
            }
        };

        navigator.mediaDevices.getUserMedia(constraints)
            .then((cameraStream) => {
                video.srcObject = cameraStream;
                stream = cameraStream;
            })
            .catch((error) => {
                console.error('Error accessing the camera:', error);
            });

        function capturePhoto() {
            if (stream) {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');

                // Set the canvas dimensions to a square shape
                const size = Math.min(video.videoWidth, video.videoHeight);
                canvas.width = size;
                canvas.height = size;

                // Calculate the cropping position to center the square
                const x = (video.videoWidth - size) / 2;
                const y = (video.videoHeight - size) / 2;


                // Draw the current frame from the video stream onto the canvas
                context.drawImage(video, x, y, size, size, 0, 0, size, size);

                // Convert the canvas content to a data URL representing the image
                const dataUrl = canvas.toDataURL('image/png');

                // Set the value of the upload input to the data URL
                // uploadInput.value = dataUrl;
                // Set the value of the user avatar
                // studentImage.value = dataUrl;


                sendImageToServer(dataUrl)

                userAvatar.src = dataUrl

                // Optionally, you can save the data URL or perform other actions here
                // For example, you can send the dataUrl to a server for further processing
                myModal.hide();
            } else {
                alert('Camera stream not available. Make sure the camera is accessible.');
            }
        }
        // CAMERA CAPTURING SECTION END

        function formatPhoneNumber(value) {
            if (!value) return value;

            const phoneNumber = value.replace(/[^\d]/g, '');
            const phoneNumberLength = phoneNumber.length;

            if (phoneNumberLength <= 2) {
                return phoneNumber;
            } else if (phoneNumberLength <= 5) {
                return `${phoneNumber.slice(0, 2)} ${phoneNumber.slice(2)}`;
            } else if (phoneNumberLength <= 7) {
                return `${phoneNumber.slice(0, 2)} ${phoneNumber.slice(2, 5)}-${phoneNumber.slice(5)}`;
            } else {
                return `${phoneNumber.slice(0, 2)} ${phoneNumber.slice(2, 5)}-${phoneNumber.slice(5, 7)}-${phoneNumber.slice(7, 9)}`;
            }
        }

        function phoneNumberFormatter() {
            const inputField = document.getElementById(event.target.id)
            const formattedInputValue = formatPhoneNumber(inputField.value)
            inputField.value = formattedInputValue;
        }

        function sendImageToServer(dataUrl) {

            fetch('/students/image', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        image: dataUrl,
                        studentId: studentId.value
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    Toast.fire({
                        icon: "success",
                        title: "Rasm muvaffaqiyatli saqlandi!"
                    });
                    return true;
                })
                .catch((error) => {
                    console.error('Error sending image to server:', error);
                    return false;
                });
        }

        async function confirmSms() {
            const phoneNumber = document.getElementById(event.target.dataset.phone);
            const sms = document.getElementById(event.target.dataset.sms);
            const formattedPhoneNumber = "998" + phoneNumber.value.replace(/[^\d]/g, '');
            const isParentsPhone = phoneNumber.name == 'phone_number' ? false : true;

            let result = await checkingConfirmationNumber(studentId.value, formattedPhoneNumber, sms.value,
                isParentsPhone);

            if (result) {
                // console.log("Confirmed");
                sms.value = '';
                if (isParentsPhone) {
                    sendSmsContactNumberButton.disabled = true;
                    contactNumberSmsConfirmationSection.classList.add('d-none');
                } else {
                    sendSmsPhoneNumberButton.disabled = true;
                    phoneNumberSmsConfirmationSection.classList.add('d-none');
                }
                phoneNumber.disabled = true;
            } else {
                console.log("Not confirmed");
            }


        }

        async function checkingConfirmationNumber(studentId, phoneNumber, sms, isParentsPhone) {
            return await fetch('/checkingConfirmationNumber', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        studentId,
                        phoneNumber,
                        sms,
                        isParentsPhone
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 'success') {
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });
                        return true;
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: data.error
                        });
                        return false;
                    }
                })
                .catch((error) => {
                    console.error('Failed on sms code validation', error);
                    return false;
                });
        }
    </script>
</body>

</html>
