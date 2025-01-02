<?php
$bill = [
  ['Ron Zacapa 23', 59.99, 2],
  ['Chivas Regal 18', 65, 1],
  ['Glenfiddich 12', 45.55, 3],
  ['Johnnie Walker Blue Label', 180, 1],
  ['Macallan 18', 250, 1],
  ['Jameson Irish Whiskey', 29.9, 4],
  ['Hennessy VS', 40, 2],
  ['Patrón Silver Tequila', 50.1, 2],
  ['Grey Goose Vodka', 55.00, 1],
  ['Baileys Irish Cream', 25.00, 3],
  ['Estrella de Galicia', .7, 24],
  ];

$total = 0;

echo "<table border='1'>";
echo "<tr>
        <th>Artículo</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Total</th>
      </tr>";

foreach ($bill as $item) {
  $name = $item[0];
  $price = number_format($item[1], 2) . "€";
  $quantity = sprintf('%02d', $item[2]);
  $cost = $item[1] * $item[2];
  $formattedCost = str_pad(number_format($cost, 2), 10, ".", STR_PAD_LEFT);

  echo "<tr>
          <td>$name</td>
          <td>$price</td>
          <td>$quantity</td>
          <td>$formattedCost</td>
        </tr>";
  
  $total += $cost;
}

$formattedCost = str_pad(number_format($cost, 2), 10, ".", STR_PAD_LEFT);
echo "<tr>
        <td colspan='3'><strong>Total</strong></td>
        <td>$formattedCost</td>
      </tr>";
echo "</table>";
?>