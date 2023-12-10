@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow-md">
        <form class="my-2">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <input type="text" id="phone" name="phone" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Position ID</label>
                <input type="text" id="position" name="position" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Photo</label>
                <input type="file" id="photo" name="photo">
            </div>

            <button id="submit" type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create User
            </button>
        </form>

        <button id="token" type="button"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Token
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submitButton = document.getElementById('submit');
            const tokenButton = document.getElementById('token');

            function token() {
                fetch('/api/token')
                    .then(response => response.json())
                    .then(data => localStorage.setItem('token', data.token))
                    .catch(error => console.log('Error:' + error));
            }

            function sendForm() {
                const formData = new FormData();

                const loading = document.createElement('div');

                loading.className = 'text-white-300 text-sm';
                loading.textContent = 'Wait...'

                submitButton.append(loading);

                formData.append("name", document.getElementById("name").value);
                formData.append("email", document.getElementById("email").value);
                formData.append("phone", document.getElementById("phone").value);
                formData.append("position_id", document.getElementById("position").value);
                formData.append("photo", document.getElementById("photo").files[0]);

                const token = localStorage.getItem('token');

                fetch('/api/users', {
                    method: 'POST',
                    headers: {
                        'Token': token
                    },
                    body: formData,
                }).then(res => {
                    loading.remove();
                    window.location.href = '/';
                }).catch((error) => {
                    loading.textContent = 'Error';
                    console.log('Error:', error);
                });
            }

            tokenButton.addEventListener('click', token);

            submitButton.addEventListener('click', function (event) {
                event.preventDefault();
                sendForm();
            });
        });
    </script>
@endsection
