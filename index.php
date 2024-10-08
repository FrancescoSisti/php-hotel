<?php
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$filter_parking = isset($_GET['parking']) ? $_GET['parking'] : '';
$filter_vote = isset($_GET['vote']) ? intval($_GET['vote']) : 0;

$filtered_hotels = [];
foreach ($hotels as $hotel) {
    $parking_condition = $filter_parking !== 'yes' || $hotel['parking'] === true;
    $vote_condition = $filter_vote === 0 || $hotel['vote'] >= $filter_vote;
    if ($parking_condition && $vote_condition) {
        $filtered_hotels[] = $hotel;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Aggiunta del form per filtrare gli hotel con parcheggio e per voto -->
        <form action="" method="GET" class="mb-4">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="parking" value="yes" id="parkingFilter"
                    <?php echo $filter_parking === 'yes' ? 'checked' : ''; ?>>
                <label class="form-check-label" for="parkingFilter">
                    Show only hotels with parking
                </label>
            </div>
            <div class="mb-3">
                <label for="voteFilter" class="form-label">Minimum vote:</label>
                <input type="number" class="form-control" id="voteFilter" name="vote" min="0" max="5"
                    value="<?php echo $filter_vote; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Parking</th>
                    <th>Vote</th>
                    <th>Distance to Center</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filtered_hotels as $hotel): ?>
                <tr>
                    <td><?php echo $hotel['name']; ?></td>
                    <td><?php echo $hotel['description']; ?></td>
                    <td><?php echo $hotel['parking'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $hotel['vote']; ?></td>
                    <td><?php echo $hotel['distance_to_center']; ?> km</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>