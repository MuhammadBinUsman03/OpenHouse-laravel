<!doctype html>
<html lang="en">
    <head>
    <title>Open House | Groups</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>

        <div class="container mt-5">
            <h1>Edit FYP Project details</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-0">
                        <h3 class>Group Name: </h3>
                    </div>
                    <div class="col">
                        <h3 id='GroupName'>...</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-0">
                        <h3 class>Project Name: </h3>
                    </div>
                    <div class="col">
                        <h3 id='ProjectName'>...</h3>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('EditProject') }}">
                @csrf

                <div class="form-group">
                    <label for="project_details">Project Details:</label>
                    <textarea class="form-control" id="project_details" name="project_details" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords">Keywords (space-separated):</label>
                    <input type="text" class="form-control" id="keywords" name="keywords" required>
                </div>
                <button type="submit" class="btn btn-primary">Edit Details</button>
            </form>
        </div>
    </body>
</html>