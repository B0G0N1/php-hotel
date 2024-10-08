<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #343a40;
        }
        .filter-form {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table {
            margin-top: 20px;
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
        .filter-section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Titolo della pagina -->
    <h1>Hotels List</h1>

    <!-- Sezione del form di filtraggio -->
    <div class="row">
        <div class="col-lg-4">
            <div class="filter-form">
                <!-- Form per il filtro -->
                <form method="GET" class="filter-section">
                    <h4>Filter Hotels</h4>
                    <!-- Filtro Parcheggio -->
                    <div class="mb-3">
                        <label for="parking" class="form-label">Has Parking?</label>
                        <select name="parking" id="parking" class="form-select">
                            <option value="">-- All --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <!-- Filtro Voto Minimo -->
                    <div class="mb-3">
                        <label for="vote" class="form-label">Minimum Vote</label>
                        <input type="number" name="vote" id="vote" class="form-control" min="1" max="5" step="1" placeholder="Enter minimum vote">
                    </div>
                    <!-- Pulsante per applicare i filtri -->
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- Sezione della tabella con i risultati degli hotel -->
        <div class="col-lg-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Parking</th>
                        <th>Vote</th>
                        <th>Distance to Center (km)</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Array di hotel
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

                // Lettura dei parametri di filtraggio (parcheggio e voto minimo)
                $filter_parking = isset($_GET['parking']) ? $_GET['parking'] : '';
                $filter_vote = isset($_GET['vote']) ? (int)$_GET['vote'] : 0;

                // Ciclo per visualizzare gli hotel filtrati
                foreach ($hotels as $hotel) {
                    // Filtra in base al parcheggio
                    if ($filter_parking !== '' && $hotel['parking'] != (bool)$filter_parking) {
                        continue;
                    }
                    // Filtra in base al voto minimo
                    if ($filter_vote > 0 && $hotel['vote'] < $filter_vote) {
                        continue;
                    }

                    // Visualizza i dati dell'hotel nella tabella
                    echo "<tr>";
                    echo "<td>{$hotel['name']}</td>";
                    echo "<td>{$hotel['description']}</td>";
                    echo "<td>" . ($hotel['parking'] ? 'Yes' : 'No') . "</td>";
                    echo "<td>{$hotel['vote']}</td>";
                    echo "<td>{$hotel['distance_to_center']}</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>