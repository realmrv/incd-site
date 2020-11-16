<div class="card">
    <div class="card-header">
        Данные для страницы {{$config['page_uid']}}
    </div>
    <div class="card-body">
        @if(isset($firstName, $lastName))
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$firstName ?? '(not set)'}}</td>
                <td>{{$lastName ?? '(not set)'}}</td>
            </tr>
            </tbody>
        </table>
        @endif
        <p>Create/Edit</p>
        <form action="/data?page_uid={{$config['page_uid']}}" method="post">
            @csrf
            <div class="form-row form-group">
                <div class="col">
                    <input name="first_name" type="text" class="form-control" placeholder="First name" required>
                </div>
                <div class="col">
                    <input name="last_name" type="text" class="form-control" placeholder="Last name" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
