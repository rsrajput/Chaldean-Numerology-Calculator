<?php
function reduceToSingleDigit($number) {
    while ($number >= 10) {
        $digits = str_split((string)$number);
        $number = array_sum($digits);
    }
    return $number;
}

function reduceForLindaGoodman($number) {
    while (!in_array($number, [11, 22]) && $number >= 10) {
        $digits = str_split((string)$number);
        $number = array_sum($digits);
    }
    return $number;
}

function calculatePartSums($nameParts, $method) {
    global $chaldeanValues;
    $results = [];

    foreach ($nameParts as $part) {
        $partSum = 0;
        $chars = str_split(strtolower($part));

        foreach ($chars as $char) {
            $partSum += $chaldeanValues[$char] ?? 0;
        }

        if ($method === 'chaldean') {
            $results[] = $partSum;
        } elseif ($method === 'linda') {
            $results[] = reduceForLindaGoodman($partSum);
        } elseif ($method === 'cheiro') {
            $results[] = reduceToSingleDigit($partSum);
        }
    }

    return $results;
}

$chaldeanValues = [
    'a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5,
    'f' => 8, 'g' => 3, 'h' => 5, 'i' => 1, 'j' => 1,
    'k' => 2, 'l' => 3, 'm' => 4, 'n' => 5, 'o' => 7,
    'p' => 8, 'q' => 1, 'r' => 2, 's' => 3, 't' => 4,
    'u' => 6, 'v' => 6, 'w' => 6, 'x' => 5, 'y' => 1,
    'z' => 7, ' ' => 0
];

$name = $_POST['name'] ?? '';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Chaldean Numerology</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        input[type="text"] { padding: 8px; width: 300px; }
        input[type="submit"] { padding: 8px 16px; }
        .result { margin-top: 20px; padding: 10px; background: #fff; border: 1px solid #ccc; }
        .row-label { display: inline-block; width: 30ch; font-weight: bold; }
    </style>
</head>
<body>

<h2>Chaldean Numerology Calculator</h2>

<form method="post">
    <label>Enter your name:</label><br><br>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
    <input type="submit" value="Calculate">
</form>

<?php if (!empty($name)): ?>
    <?php
    $nameParts = preg_split('/\s+/', trim($name));
    $formattedName = ucwords(strtolower($name));

    $chaldeanParts = calculatePartSums($nameParts, 'chaldean');
    $lindaParts = calculatePartSums($nameParts, 'linda');
    $cheiroParts = calculatePartSums($nameParts, 'cheiro');

    $chaldeanTotal = array_sum($chaldeanParts);
    $lindaTotal = array_sum($lindaParts);
    $cheiroTotal = array_sum($cheiroParts);
    ?>

    <div class="result">
        <h3>Numerology Totals for: <?= htmlspecialchars($formattedName) ?></h3>
        <p><span class="row-label">Chaldean Numerology</span>: <?= json_encode($chaldeanParts) ?> & <?= $chaldeanTotal ?></p>
        <p><span class="row-label">Linda Goodman Numerology</span>: <?= json_encode($lindaParts) ?> & <?= $lindaTotal ?></p>
        <p><span class="row-label">Cheiro Numerology</span>: <?= json_encode($cheiroParts) ?> & <?= $cheiroTotal ?></p>
    </div>
<?php endif; ?>

</body>
</html>
