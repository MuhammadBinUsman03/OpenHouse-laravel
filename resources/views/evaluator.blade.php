<!doctype html>
<html lang="en">
<head>
    <title>Open House | Evaluators</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class='container mt-5'>
    <h1>Evaluations</h1>
    <div class="row">
    <?php foreach ($records as $record): ?>
        <div class="col-md-4 mb-3">
            <div class="card bg-light m-2">
                <h5 class="card-header" style="height: 60px;"><?php echo $record['project_name']; ?></h5>
                <div class="card-body "  style="height: 250px";>
                    <p class="card-title">Project Details: <?php echo $record['project_details']; ?></p>
                    <p class="card-text">Location: <?php echo $record['location']; ?></p>
                    <?php if ($record['evaluation_rating'] !== 'null'): ?>
                        <p class="card-text">Evaluation Rating: <?php echo $record['evaluation_rating']; ?></p>

                    <?php else: ?>
                        <!-- Display a form to rate the project -->
                        <form method="POST" action="{{ route('EvaluateProjects', ['evaluatorId' => $evaluatorId]) }}">
                            @csrf
                            <!-- Include hidden fields for the project ID and other necessary data -->
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo $record['project_id']; ?>">
                            <!-- Add a dropdown or input field for rating -->
                            <label for="rating">Rate the project:</label>
                            <div class="row ">
                                <div class="col-4"><input type="number"  class='form-control mb-1' name="rating" id="rating" min="1" max="10" required></div>
                                <div class="col "><button type="submit" class="btn btn-danger">Submit Rating</button></div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    </div>
</body>
</html>
