<?php
// Крок 7: Увімкнення відображення помилок на час розробки для перевірки результату[cite: 3]
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Крок 2: Оголосити масив даних свого домену
// Масив рослин містить поля: name, wateringIntervalDays, daysSinceWatered
$plants = [
    ['name' => 'Рододендрон', 'wateringIntervalDays' => 7, 'daysSinceWatered' => 5],
    ['name' => 'Ялівець', 'wateringIntervalDays' => 10, 'daysSinceWatered' => 12],
    ['name' => 'Платан', 'wateringIntervalDays' => 14, 'daysSinceWatered' => 14],
    ['name' => 'Спатіфілум', 'wateringIntervalDays' => 4, 'daysSinceWatered' => 2],
    ['name' => 'Клематіс', 'wateringIntervalDays' => 7, 'daysSinceWatered' => 8],
];

// Крок 3: Написати функцію форматування
// Типізована функція, яка приймає один запис масиву і повертає рядок[cite: 2]
function formatPlant(array $plant): string {
    return "<strong>{$plant['name']}</strong> (Інтервал поливу: {$plant['wateringIntervalDays']} дн., Минуло днів: {$plant['daysSinceWatered']})";
}

// Змінна для кроку 6 (Агрегатний показник)
$plantsNeedingWater = 0;
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Каталог догляду за рослинами</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .card { border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px; }
        .needs-water { color: red; font-weight: bold; }
        .ok { color: green; }
        .aggregate { margin-top: 20px; padding: 15px; background-color: #f0f8ff; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Мій каталог рослин</h1>
    
    <div class="plants-list">
        <?php foreach ($plants as $plant): ?>
            <?php
                // Крок 4: Додати умовну логіку[cite: 2]
                // Якщо daysSinceWatered >= wateringIntervalDays - мітка «Потребує поливу»[cite: 4]
                if ($plant['daysSinceWatered'] >= $plant['wateringIntervalDays']) {
                    $status = 'Потребує поливу';
                    $statusClass = 'needs-water';
                    $plantsNeedingWater++; // Збільшуємо лічильник для агрегатного показника
                } else {
                    $status = 'Поливу не потребує';
                    $statusClass = 'ok';
                }
            ?>
            <div class="card">
                <!-- Крок 5: Вивести дані у вебсторінку, поєднуючи РНР-код з HTML[cite: 3] -->
                <p><?= formatPlant($plant) ?></p>
                <p>Статус: <span class="<?= $statusClass ?>"><?= $status ?></span></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Крок 6: Вивести агрегатний показник окремим блоком[cite: 3] -->
    <div class="aggregate">
        <h2>Підсумок</h2>
        <!-- Агрегат: кількість рослин, що потребують поливу сьогодні[cite: 4] -->
        <p>Кількість рослин, що потребують поливу сьогодні: <strong><?= $plantsNeedingWater ?></strong></p>
    </div>
</body>
</html>