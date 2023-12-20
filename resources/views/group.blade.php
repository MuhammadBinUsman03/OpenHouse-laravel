<!doctype html>
<html lang="en">
    <head>
    <title>Open House | Groups</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <?php
            
            if($project){
                echo "<div class='container mt-5' id='GroupDetails'><h1>Project Details</h1>";
                echo "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col p-0'>
                            <h4>Project Name </h4>
                        </div>
                        <div class='col'>
                            <b>$project->project_name</b>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col p-0'>
                            <h4>Description </h4>
                        </div>
                        <div class='col'>
                            <b id='ProjDetails'>$project->project_details</b>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col p-0'>
                            <h4>Keywords </h4>
                        </div>
                        <div class='col'>
                            <b id='ProjKeywords'>$project->project_keywords</b>
                        </div>
                    </div>
                </div>
                ";
                echo "<h1> Edit Project Details</h1></div>";
                
                // Edit form
                // echo "
                // <form method='POST' action='{{ route('EditProject') }}'>
                //     @csrf
                //     <div class='form-group'>
                //         <label for='project_details'>Project Details:</label>
                //         <textarea class='form-control' id='project_details' name='project_details' rows='4' required></textarea>
                //     </div>
                //     <div class='form-group'>
                //         <label for='keywords'>Keywords (space-separated):</label>
                //         <input type='text' class='form-control' id='keywords' name='keywords' required>
                //     </div>
                //     <button type='submit' class='btn btn-primary'>Edit Details</button>
                // </form>
                // </div>
                // ";
            }
        ?>
        <script>
            document.getElementById('GroupDetails').innerHTML += `
            <form method='POST' action="{{ route('EditProject',['projectId'=>$project->project_id]) }}">
                    @csrf
                    <div class='form-group'>
                        <label for='project_details'>Project Details:</label>
                        <textarea class='form-control' id='project_details' name='project_details' rows='4' required></textarea>
                    </div>
                    <div class='form-group'>
                        <label for='keywords'>Keywords (space-separated):</label>
                        <input type='text' class='form-control' id='keywords' name='keywords' required>
                    </div>
                    <button type='submit' class='btn btn-primary'>Edit Details</button>
                </form>
                </div>
            `;
        </script>
    </body>
</html>