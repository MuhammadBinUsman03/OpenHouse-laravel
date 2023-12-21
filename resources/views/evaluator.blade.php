<!doctype html>
<html lang="en">
<head>
    <title>Open House | Evaluators</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>Evaluations</h1>
    <?php foreach ($records as $record): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $record['project_name']; ?></h5>
                <p class="card-text">Project Details: <?php echo $record['project_details']; ?></p>
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
                        <input type="number" name="rating" id="rating" min="1" max="10" required>
                        <button type="submit">Submit Rating</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
