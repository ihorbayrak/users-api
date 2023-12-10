@extends('layouts.app')

@section('content')
    <a href="{{ route('web.users.create') }}" class="text-blue-800 font-bold py-2 px-4">
        Register
    </a>

    <div id="container" class="m-auto grid grid-cols-6 justify-center">
    </div>

    <div class="flex justify-center my-4">
        <button id="show-more" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Show More
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userContainer = document.getElementById('container');
            const loadMoreBtn = document.getElementById('show-more');

            const count = 6;
            let currentPage = 1;

            const fetchUsers = async (page) => {
                try {
                    const response = await fetch(`/api/users?page=${page}&count=${count}`);
                    const data = await response.json();
                    return data;
                } catch (error) {
                    console.log('Error during fetching users:' + error);
                }
            };

            const renderUsers = (users) => {
                users.forEach(user => {
                    const userCard = document.createElement('div');

                    userCard.className = 'max-w-full mx-2 my-4 bg-white rounded-lg shadow-md';

                    userCard.innerHTML = `
                        <img class="w-70 h-70 rounded-full mx-auto mt-4" src="${user.photo}" alt="${user.name}">
                        <div class="max-w-full px-2 py-2">
                            <div class="font-bold text-xl mb-2">${user.name}</div>
                            <p class="text-gray-700 text-base">${user.email}</p>
                            <p class="text-gray-700 text-base">${user.phone}</p>
                            <p class="text-gray-700 text-base">${user.position}</p>
                        </div>
                    `;
                    userContainer.append(userCard);
                });
            };

            const loadUsers = async () => {
                const {users} = await fetchUsers(currentPage++);

                renderUsers(users);
            };

            loadMoreBtn.addEventListener('click', loadUsers); // Pagination

            loadUsers(); // Initial loading
        })
    </script>
@endsection
