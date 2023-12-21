<!doctype html>
<html lang="en">
<head>
    <title>Open House | Admin Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Admin Portal</h2>
            </div>
            <div class="col-md-6">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" onclick="showAddProject()">Add Project</button>
                    <button type="button" class="btn btn-success" onclick="RegisterEvaluator()">Register Evaluator</button>
                    <button type="button" class="btn btn-secondary" onclick="showManageLocations()">Manage Locations</button>
                </div>
            </div>
        </div>
        <hr>
        <div id="content">
            <!-- Initial content to be replaced -->
            <h3>Welcome! Select an option above.</h3>
        </div>
    </div>

    <script>
        function showAddProject() {
            document.getElementById('content').innerHTML = `
                <div class="container mt-5">
            <h1>Add FYP Project details</h1>
            <form method="POST" action="{{ route('SubmitProject') }}">
                @csrf
                <div class="form-group">
                    <label for="project_name">Project Name:</label>
                    <input type="text" class="form-control" id="project_name" name="project_name" required>
                </div>
                <div class="form-group">
                    <label for="member_count">Number of Project Members:</label>
                    <select class="form-control" id="member_count" name="member_count" >
                        <option value="">Select number of members...</option> <!-- Initial empty option -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div id="member_names">
                    <!-- This section will be dynamically filled based on selected member count -->
                </div>
                <div class="form-group">
                    <label for="project_details">Project Details:</label>
                    <textarea class="form-control" id="project_details" name="project_details" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords">Keywords (space-separated):</label>
                    <input type="text" class="form-control" id="keywords" name="keywords" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Project</button>
            </form>
        </div>
            `;

        // Function to dynamically generate input fields for member names based on selected count
        document.getElementById('member_count').addEventListener('change', function() {
            var count = parseInt(this.value);
            var memberNamesDiv = document.getElementById('member_names');
            memberNamesDiv.innerHTML = ''; // Clear previous fields

            for (var i = 1; i <= count; i++) {
                var inputField = document.createElement('div');
                inputField.classList.add('form-group');
                inputField.innerHTML = '<label for="member_' + i + '">Project Member ' + i + ' Name:</label>' +
                                        '<input type="text" class="form-control" id="member_' + i + '" name="member_' + i + '" required>';
                memberNamesDiv.appendChild(inputField);
            }   
        });
        }

        function RegisterEvaluator() {
            document.getElementById('content').innerHTML = `
                <div class="container mt-5">
                    <h1>Add Evaluator</h1>
                    <form method="POST" action="{{ route('RegisterEvaluator') }}">
                        @csrf
                        <div class="form-group">
                            <label for="evaluator_name">Evaluator Name:</label>
                            <input type="text" class="form-control" id="evaluator_name" name="evaluator_name" required>
                        </div>
                        <div class="form-group">
                            <label for="evaluator_preferences">Preferences:</label>
                            <input type="text" class="form-control" id="evaluator_preferences" name="evaluator_preferences" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Evaluator</button>
                    </form>
                </div>
            `;
        }

        function showManageLocations() {
            document.getElementById('content').innerHTML = `
                <h1>Manage Locations</h1>
                <!-- Content for managing locations goes here -->
            `;
        }
    </script>
    </body>
</html>