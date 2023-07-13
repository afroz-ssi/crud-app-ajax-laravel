@extends('layouts.main')

@section('title', 'All Post Lists')

@section('content')

    <div class="grid grid-cols-1 font-serif">
        <div class="ml-2 mr-2 home-content mb-4 shadow shadow-md p-5 shadow-gray-400 w-10/10 text-justify">
            <div class="flex justify-around">
                <strong>
                    <h1 class="text-2xl">Post Lists</h1>
                </strong>
                <h2 class="uppercase"><strong>Loged User - </strong> <span id="LogedUSer">Loged USer</span> </h2>

                <button title="Create Post" onclick="EditForm()" data-toggle="modal" data-target="#myModal"
                    class="rounded hover:rounded-xl bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4">
                    <i class="fa fa-pencil-square "></i>
                    Create Post
                </button>

                <button onclick="LogoutUser()">
                    <strong class="underline"> Logout</strong>
                </button>

            </div>
        </div>
        <div class="table-content">
            <div class="flex justify-center">
                <table class="table-auto w-10/12 border-2">
                    <thead class="border border-cyan-200 w-6/12 bg-indigo-700 text-white">
                        <tr class="border border-solid border-2 bold">
                            <th class="text-md px-6 py-3 border-2">S.No</th>
                            <th class="text-md px-6 py-3 border-2">Title</th>
                            <th class="text-md px-6 py-3 border-2">Description</th>
                            <th class="text-md px-6 py-3 border-2">Category</th>
                            <th class="text-md px-6 py-3 border-2">Post Active</th>
                            <th class="text-md px-6 py-3 border-2">Author</th>
                            <th class="text-md w-30 px-3 border-2 text-center">
                                Action <i class="fa fa-thumbs-up"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">

                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <!-- Create / Edit Modal -->
    <div class="modal fade font-serif" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <strong>
                        <h4 class="modal-title" id="titleChange"></h4>
                    </strong>
                </div>
                <div class="modal-body">
                    <div id="AddEditForm">
                        <form class="form" id="Updateform">
                            <p class="text-center text-green-400 text-4xl" id="Msg"></p>
                            <input type="hidden" id="user_id">
                            <input type="hidden" id="postId">

                            <div class="form-group">
                                <div class="text-left">Post Title</div>
                                <input type="text" id="title" name="title"
                                    class="appearance-none px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100"
                                    placeholder="Enter Your Post Title" autocomplete="off" />
                                <p class="text-left text-red-400 error-text title_error" id="title_error"></p>

                            </div>
                            <div class="form-group">
                                <div class="text-left">Description</div>
                                <textarea type="text" id="desc"
                                    class="px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100 w-full"
                                    placeholder="Enter Your Post Description" autocomplete="off"></textarea>
                                <p class="text-left text-red-400 error-text description_error" id="description_error"></p>
                            </div>
                            <div class="form-group">
                                <div class="text-left">Category</div>
                                <select
                                    class="appearance-none w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100"
                                    name="category" id="category">
                                    @if (count($category) > 0)
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}" id="{{ $cat->id }}">
                                                {{ $cat->category_name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                                <p class="text-left text-red-400 error-text category_error" id="category_error"></p>
                            </div>
                            <div class="form-group">
                                <div class="flex items-center">
                                    <input id="IsActive" type="checkbox" value="1"
                                        class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded ">
                                    <label for="checked-checkbox"
                                        class="ml-2 text-md font-medium text-dark-900
                                 dark:text-dark-300 mt-3">Is
                                        Active
                                        ?</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button
                                    class="rounded hover:rounded-xl bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>



    {{-- // ======== Delete Modal  --}}


    <div class="modal fade font-serif" id="deleteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <strong>
                        <h4 class="modal-title uppercase" id="titleChange"> Delete Post</h4>
                    </strong>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_id">
                    <p id="delete_msg"></p>

                    <div class="modal-contente text-center grid grid-cols-1 font-serif mt-2">
                        <div class="delete">
                            <h1 class="text-4xl">Are You Sure ?</h1>
                            <p>You will not be able to see this post futher!. </p>
                        </div>
                        <div class="btn text-right flex justify-center mt-2">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button onclick="DeletePost()"
                                    class="rounded hover:rounded-xl bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">
                                    Yes, Delete It.
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        td a:hover {
            color: white
        }
    </style>

    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            headers: {
                Authorization: "Bearer " + sessionStorage.getItem("access_token"),
            },

        });


        //  ============____________ Load post lists ____________ ================


        $(document).ready(function() {
            let logedUserNAme = sessionStorage.getItem("LogedUserName");
            $("#LogedUSer").html(logedUserNAme);           
            LoadPostLists();
        });

        function LoadPostLists(){
            $.ajax({
                url: 'http://127.0.0.1:8000/api/user/postlist',
                method: 'GET',
                success: function(response) {
                    // console.log(response);
                    var tableBody = $('#tableBody');
                    tableBody.empty();
                    // ==========  Iterate post items=====
                    response.data.forEach(function(user) {
                        let IsPostActive = (user.IsActive) ? "YES" : "NO";
                        var row = $('<tr></tr>');
                        row.append('<td class="text-md px-6 py-3 border-2">' + user.id + '</td>');
                        row.append('<td class="text-md px-6 py-3 border-2">' + user.title +'</td>');
                        row.append('<td class="text-md px-6 py-3 border-2">' + user.description + '</td>');
                        row.append('<td class="text-md px-6 py-3 border-2">' + user.category.category_name + '</td>');
                        row.append('<td class="text-md px-6 py-3 border-2">' + IsPostActive + '</td>');
                        row.append('<td class="text-md px-6 py-3 border-2">' + user.user.name +'</td>');
                        row.append(`<td class="text-md px-6 py-3 flex border-2">
                                <a class="fa fa-edit bg-green-700 text-white p-2 shadow shadow-gray-800 rounded-full" onclick="EditForm(${user.id})" data-toggle="modal" data-target="#myModal">
                                    <i title="Edit Post"></i>
                                </a>
                                <a class="fa fa-trash bg-red-700 text-white p-2 shadow shadow-gray-800 rounded-full mx-1" onclick="setDeletePost(${user.id})" data-toggle="modal" data-target="#deleteModal">
                                     <i title="Delete Post"></i>
                                </a>
                            </td>`);
                        tableBody.append(row);
                    });
                },
                error: function(err) {
                    // console.log(err.statusText);
                    if (err.responseJSON.status == 401) {
                        alert(err.responseJSON.error);
                        window.open("{{ route('login') }}", "_self");                        
                    }
                    if (err.responseJSON.status == 404) {
                        var tableBody = $('#tableBody');
                        var row = $('<tr></tr>');
                        row.append('<td class="text-md px-6 py-3 border-3 text-center text-red-400">' +
                            err.responseJSON.error + '</td>');
                        tableBody.append(row);
                        console.log(err.responseJSON.error);
                    }
                }
            });
        }

        //  ============____________ Edit  Form ____________ ================

        function EditForm(editId = 0) {
            $("#titleChange").empty().html();
            if (editId) {
                // console.log("editId", editId);
                $("#titleChange").append("Update Post");
                $("#postId").val(editId);
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/user/edit/' + editId,
                    method: 'GET',
                    success: function(response) {
                        console.log(response.post_data);
                        // let post_id = response.post_data[0]['id'];
                        let user_id = response.post_data[0]['user_id'];
                        $("#user_id").val(user_id);
                        $("#title").val(response.post_data[0]['title']);
                        $("#desc").val(response.post_data[0]['description']);
                        $("#IsActive").prop("checked", true);
                    },
                    error: function(error) {
                        if (error.responseJSON.status == 404) {
                            console.log(error);
                            alert(error.responseJSON.error);
                        }
                    }
                });
            } else {
                $('#Updateform')[0].reset();
                $("#user_id").val("");
                $("#titleChange").append("Create Post");
            }
        }

        $("#Updateform").on("submit", function(e) {
            e.preventDefault();
            let title = $("#title").val();
            let desc = $("#desc").val();
            let cate = $("#category").val();           
            let IsActive = $("#IsActive").is(":checked") == true ? 1 : 0;
            let user_id = $("#user_id").val();
            let postId = $("#postId").val();

            //  ============____________ Update Form ____________ ================
            if (user_id > 0) {
                $.ajax({
                    url: `http://127.0.0.1:8000/api/user/update-post/${postId}`,
                    method: 'PUT',
                    data: {
                        title: title,
                        description: desc,
                        category_id: cate,
                        IsActive: IsActive,
                        user_id: user_id,
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#Msg').html(response.message);
                        alert(response.message);
                        LoadPostLists();
                        setTimeout(() => {
                            $('#myModal').modal('hide');
                            $('#Msg').html("");
                        }, 1000);
                    },
                    error: function(error) {
                        if (error.responseJSON.status == 404) {
                            console.log(error);
                            alert(error.responseJSON.error);
                        }
                    }
                });
                
            } else {

                //  ============_____________ Create Post  _____________ ================
                // alert("Create From submit");
                let logedUserId = sessionStorage.getItem("LogedUserId");
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/user/create-post',
                    method: 'POST',
                    data: {
                        title: title,
                        description: desc,
                        category: cate,
                        IsActive: IsActive,
                        user_id: logedUserId,
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#Msg').html(response.message);
                        alert(response.message);
                        LoadPostLists();
                        $('#Updateform')[0].reset();
                        $('.error-text').html("");
                        // setTimeout(() => {
                            $('#myModal').modal('hide');
                            $('#Msg').html("");
                        // }, 1000);
                    },
                    error: function(error) {
                        if (error.responseJSON.error) {
                            $('#Msg').html(error.responseJSON.error);
                        }
                        if (error.responseJSON.status == 404) {
                            $.each(error.responseJSON.errors, function(prefix, val) {
                                $('p.' + prefix + '_error').text(val[0]);
                            });
                        }
                    }
                });
            }

        });

        function setDeletePost(id) {
            $("#delete_id").val(id); // set id on open modal
        }

        function DeletePost() {
            let dlt_id = $("#delete_id").val();
            // console.log("delete_id get " + dlt_id);
            $.ajax({
                url: `http://127.0.0.1:8000/api/user/delete-post/${dlt_id}`,
                method: 'DELETE',
                success: function(response) {
                    alert(response.message);
                    LoadPostLists();
                    setTimeout(() => {
                        $('#deleteModal').modal('hide');
                    }, 1000);
                },
                error: function(error) {
                    if (error.responseJSON.error) {
                        $('#delete_msg').html(error.responseJSON.error);
                    }
                    if (error.responseJSON.status == 404) {
                        $.each(error.responseJSON.errors, function(prefix, val) {
                            $('p.' + prefix + '_error').text(val[0]);
                        });
                    }
                }
            });
        }

        function LogoutUser() {
            alert("LogoutUser");
            $.ajax({
                url: `http://127.0.0.1:8000/api/user/logout`,
                method: 'POST',
                success: function(response) {                    
                    alert(response.message);
                     sessionStorage.removeItem("access_token");
                     sessionStorage.removeItem("LogedUserId");
                     sessionStorage.removeItem("LogedUserName");
                     window.open("{{ route('login') }}", "_self");                        
                },
                error: function(error) {
                    console.log(error.responseJSON.error) 
                }
            });
        }


    </script>
@endsection
