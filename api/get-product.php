<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$id = $_GET['id'] ?? 1;

$products = [
    125 => ['id'=>125,'name'=>'Refrigerantes Lata 350ml','description'=>'Refrigerante lata 350ml bem gelado. Escolha seu sabor favorito.','price'=>'5.90','old_price'=>null,'image'=>'images/product_1772651599_69a8844f37559.webp','allow_observations'=>1],
    126 => ['id'=>126,'name'=>'Refrigerante 1 Litro','description'=>'Refrigerante gelado em garrafa de 1 litro.','price'=>'9.90','old_price'=>null,'image'=>'images/product_1772651637_69a88475e4637.webp','allow_observations'=>1],
    127 => ['id'=>127,'name'=>'Água Mineral Sem Gás – 500ml','description'=>'Água mineral natural sem gás, leve e refrescante. Ideal para acompanhar sua refeição e manter a hidratação a qualquer momento.','price'=>'3.90','old_price'=>null,'image'=>'images/product_1772651683_69a884a3212f7.webp','allow_observations'=>0],
    151 => ['id'=>151,'name'=>'Água Mineral Com Gás – 500ml','description'=>'Água mineral natural com gás, refrescante e levemente gaseificada. Ideal para acompanhar sua refeição e realçar os sabores.','price'=>'5.90','old_price'=>null,'image'=>'images/product_1772660073_69a8a56979f87.webp','allow_observations'=>0],
    152 => ['id'=>152,'name'=>'H2OH! Limão – 500ml','description'=>'H2OH! Limão 500ml.','price'=>'6.50','old_price'=>null,'image'=>'images/product_1772660102_69a8a5866d01f.webp','allow_observations'=>0],
    153 => ['id'=>153,'name'=>'H2OH! – Original 500ml','description'=>'H2OH! Original 500ml.','price'=>'6.90','old_price'=>null,'image'=>'images/product_1772660136_69a8a5a84c6da.webp','allow_observations'=>0],
    154 => ['id'=>154,'name'=>'Suco Del Valle Lata – Sabores Variados','description'=>'Sucos Del Valle em lata.','price'=>'5.90','old_price'=>null,'image'=>'images/product_1772660167_69a8a5c743469.webp','allow_observations'=>0],
    155 => ['id'=>155,'name'=>'2 Pizzas GG + Pizza Doce G','description'=>'2 Pizzas tamanho GG salgadas + 1 Pizza Doce G. Sabores à sua escolha nos opcionais. Ideal para compartilhar!','price'=>'68.90','old_price'=>'84.90','image'=>'images/product_1772665229_69a8b98dd27e1.webp','allow_observations'=>1],
    156 => ['id'=>156,'name'=>'2 Pizzas G + Pizza Doce G','description'=>'2 Pizzas tamanho G + 1 Pizza Doce tamanho G. Sabores à sua escolha nos opcionais. Perfeito para compartilhar!','price'=>'62.90','old_price'=>'69.90','image'=>'images/product_1772665501_69a8ba9d91a75.webp','allow_observations'=>1],
    157 => ['id'=>157,'name'=>'2 Pizzas G + Refri 2L','description'=>'A escolha ideal para dividir e aproveitar muito sabor. Duas pizzas tamanho G, com massa macia por dentro, bordas douradas e recheio caprichado, preparadas na hora. Acompanha refrigerante de 1 litro para completar a refeição.','price'=>'52.90','old_price'=>'59.90','image'=>'images/product_1772666423_69a8be37aec34.webp','allow_observations'=>1],
    158 => ['id'=>158,'name'=>'Pizza P','description'=>'Escolha sua pizza favorita no tamanho P. Massa leve, molho artesanal e aquele recheio caprichado que você merece.','price'=>'23.90','old_price'=>'24.90','image'=>'images/product_1772667521_69a8c281561a2.webp','allow_observations'=>1],
    159 => ['id'=>159,'name'=>'Pizza M','description'=>'Escolha sua pizza favorita no tamanho M. Massa leve, molho artesanal e aquele recheio caprichado que você merece.','price'=>'27.90','old_price'=>'29.90','image'=>'images/product_1772668117_69a8c4d5975bf.webp','allow_observations'=>1],
    160 => ['id'=>160,'name'=>'Pizza G','description'=>'Escolha sua pizza favorita no tamanho G. Massa leve, molho artesanal e aquele recheio caprichado que você merece.','price'=>'37.90','old_price'=>'42.90','image'=>'images/product_1772668290_69a8c582b71c7.webp','allow_observations'=>1],
    161 => ['id'=>161,'name'=>'Pizza GG','description'=>'A escolha certa para quem não brinca quando o assunto é pizza. Nossa pizza tamanho GG vem com massa leve, molho artesanal e muito recheio, ideal para dividir com a galera ou matar a fome de verdade.','price'=>'44.90','old_price'=>'49.90','image'=>'images/product_1772668479_69a8c63fc0547.webp','allow_observations'=>1],
    162 => ['id'=>162,'name'=>'Combo 4 Esfirras Salgadas + 1 Doce','description'=>'4 esfirras salgadas + 1 doce. Escolha os sabores nos opcionais e aproveite!','price'=>'24.90','old_price'=>'29.90','image'=>'images/product_1772668597_69a8c6b575574.webp','allow_observations'=>1],
    163 => ['id'=>163,'name'=>'Combo 5 Esfirras + Refri 1L','description'=>'Ideal para lanche, compartilhar ou matar a fome com variedade e muito sabor.','price'=>'29.90','old_price'=>'34.90','image'=>'images/product_1772668636_69a8c6dc4711f.webp','allow_observations'=>1],
];

$categories = [
    155 => [
        [
            'id' => 1, 'name' => 'ESCOLHA SUA BORDA', 'max' => 1,
            'items' => [
                ['id'=>101,'name'=>'SEM BORDA RECHEADA','price'=>0],
                ['id'=>102,'name'=>'BORDA DE CATUPIRY (ORIGINAL)','price'=>0],
                ['id'=>103,'name'=>'BORDA DE REQUEIJÃO','price'=>0],
                ['id'=>104,'name'=>'BORDA DE CHEDDAR','price'=>0],
                ['id'=>105,'name'=>'BORDA DE CHOCOLATE BRANCO','price'=>0],
                ['id'=>106,'name'=>'BORDA DE CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 2, 'name' => 'ESCOLHA SUA PIZZA', 'max' => 2,
            'items' => [
                ['id'=>201,'name'=>'FRANGO','price'=>0],
                ['id'=>202,'name'=>'FRANGO COM CATUPIRY','price'=>0],
                ['id'=>203,'name'=>'CALABRESA ACEBOLADA','price'=>0],
                ['id'=>204,'name'=>'CALABRESA MOÍDA','price'=>0],
                ['id'=>205,'name'=>'PORTUGUESA','price'=>0],
                ['id'=>206,'name'=>'MUSSARELA','price'=>0],
                ['id'=>207,'name'=>'PEPPERONI','price'=>0],
                ['id'=>208,'name'=>'4 QUEIJOS','price'=>0],
                ['id'=>209,'name'=>'MARGUERITA','price'=>0],
                ['id'=>210,'name'=>'BACON','price'=>0],
                ['id'=>211,'name'=>'CARNE SECA COM CATUPIRY','price'=>0],
                ['id'=>212,'name'=>'CAMARÃO','price'=>3.90],
                ['id'=>213,'name'=>'BACON DEFUMADO ESPECIAL','price'=>2.90],
                ['id'=>214,'name'=>'CARNE DE SOL DESFIADA','price'=>3.90],
            ]
        ],
        [
            'id' => 3, 'name' => 'ESCOLHA SUA PIZZA DOCE', 'max' => 2,
            'items' => [
                ['id'=>301,'name'=>'BANANA COM CHOCOLATE','price'=>0],
                ['id'=>302,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>303,'name'=>'DOCE DE LEITE COM BANANA','price'=>0],
                ['id'=>304,'name'=>'CHOCOLATE BRANCO','price'=>0],
                ['id'=>305,'name'=>'BANANA NEVADA','price'=>0],
                ['id'=>306,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>307,'name'=>'CHOCOLATE','price'=>0],
            ]
        ],
    ],
    156 => [
        [
            'id' => 4, 'name' => 'ESCOLHA SUA BORDA', 'max' => 1,
            'items' => [
                ['id'=>401,'name'=>'SEM BORDA RECHEADA','price'=>0],
                ['id'=>402,'name'=>'BORDA DE CATUPIRY (ORIGINAL)','price'=>0],
                ['id'=>403,'name'=>'BORDA DE REQUEIJÃO','price'=>0],
                ['id'=>404,'name'=>'BORDA DE CHEDDAR','price'=>0],
                ['id'=>405,'name'=>'BORDA DE CHOCOLATE BRANCO','price'=>0],
                ['id'=>406,'name'=>'BORDA DE CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 5, 'name' => 'ESCOLHA SUA PIZZA', 'max' => 2,
            'items' => [
                ['id'=>501,'name'=>'FRANGO','price'=>0],
                ['id'=>502,'name'=>'FRANGO COM CATUPIRY','price'=>0],
                ['id'=>503,'name'=>'CALABRESA ACEBOLADA','price'=>0],
                ['id'=>504,'name'=>'CALABRESA MOÍDA','price'=>0],
                ['id'=>505,'name'=>'PORTUGUESA','price'=>0],
                ['id'=>506,'name'=>'MUSSARELA','price'=>0],
                ['id'=>507,'name'=>'PEPPERONI','price'=>0],
                ['id'=>508,'name'=>'4 QUEIJOS','price'=>0],
                ['id'=>509,'name'=>'MARGUERITA','price'=>0],
                ['id'=>510,'name'=>'BACON','price'=>0],
                ['id'=>511,'name'=>'CARNE SECA COM CATUPIRY','price'=>0],
                ['id'=>512,'name'=>'CAMARÃO','price'=>3.90],
                ['id'=>513,'name'=>'BACON DEFUMADO ESPECIAL','price'=>2.90],
                ['id'=>514,'name'=>'CARNE DE SOL DESFIADA','price'=>3.90],
            ]
        ],
        [
            'id' => 6, 'name' => 'ESCOLHA SUA PIZZA DOCE', 'max' => 2,
            'items' => [
                ['id'=>601,'name'=>'BANANA COM CHOCOLATE','price'=>0],
                ['id'=>602,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>603,'name'=>'DOCE DE LEITE COM BANANA','price'=>0],
                ['id'=>604,'name'=>'CHOCOLATE BRANCO','price'=>0],
                ['id'=>605,'name'=>'BANANA NEVADA','price'=>0],
                ['id'=>606,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>607,'name'=>'CHOCOLATE','price'=>0],
            ]
        ],
    ],
    157 => [
        [
            'id' => 7, 'name' => 'ESCOLHA SUA BORDA', 'max' => 1,
            'items' => [
                ['id'=>701,'name'=>'SEM BORDA RECHEADA','price'=>0],
                ['id'=>702,'name'=>'BORDA DE CATUPIRY (ORIGINAL)','price'=>0],
                ['id'=>703,'name'=>'BORDA DE REQUEIJÃO','price'=>0],
                ['id'=>704,'name'=>'BORDA DE CHEDDAR','price'=>0],
                ['id'=>705,'name'=>'BORDA DE CHOCOLATE BRANCO','price'=>0],
                ['id'=>706,'name'=>'BORDA DE CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 8, 'name' => 'ESCOLHA SUA PIZZA', 'max' => 2,
            'items' => [
                ['id'=>801,'name'=>'FRANGO','price'=>0],
                ['id'=>802,'name'=>'FRANGO COM CATUPIRY','price'=>0],
                ['id'=>803,'name'=>'CALABRESA ACEBOLADA','price'=>0],
                ['id'=>804,'name'=>'CALABRESA MOÍDA','price'=>0],
                ['id'=>805,'name'=>'PORTUGUESA','price'=>0],
                ['id'=>806,'name'=>'MUSSARELA','price'=>0],
                ['id'=>807,'name'=>'PEPPERONI','price'=>0],
                ['id'=>808,'name'=>'4 QUEIJOS','price'=>0],
                ['id'=>809,'name'=>'MARGUERITA','price'=>0],
                ['id'=>810,'name'=>'BACON','price'=>0],
                ['id'=>811,'name'=>'CARNE SECA COM CATUPIRY','price'=>0],
                ['id'=>812,'name'=>'CAMARÃO','price'=>3.90],
                ['id'=>813,'name'=>'BACON DEFUMADO ESPECIAL','price'=>2.90],
                ['id'=>814,'name'=>'CARNE DE SOL DESFIADA','price'=>3.90],
            ]
        ],
        [
            'id' => 9, 'name' => 'ESCOLHA SUA PIZZA DOCE', 'max' => 2,
            'items' => [
                ['id'=>901,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>902,'name'=>'BANANA NEVADA','price'=>0],
                ['id'=>903,'name'=>'CHOCOLATE BRANCO','price'=>0],
                ['id'=>904,'name'=>'DOCE DE LEITE COM BANANA','price'=>0],
                ['id'=>905,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>906,'name'=>'BANANA COM CHOCOLATE','price'=>0],
                ['id'=>907,'name'=>'CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 10, 'name' => 'ESCOLHA SEU REFRIGERANTE', 'max' => 1,
            'items' => [
                ['id'=>1001,'name'=>'COCA COLA','price'=>0],
                ['id'=>1002,'name'=>'COCA COLA ZERO','price'=>0],
                ['id'=>1003,'name'=>'FANTA LARANJA','price'=>0],
                ['id'=>1004,'name'=>'GUARANÁ','price'=>0],
            ]
        ],
    ],
    158 => [
        [
            'id' => 11, 'name' => 'ESCOLHA SUA BORDA', 'max' => 1,
            'items' => [
                ['id'=>1101,'name'=>'SEM BORDA RECHEADA','price'=>0],
                ['id'=>1102,'name'=>'BORDA DE CATUPIRY (ORIGINAL)','price'=>0],
                ['id'=>1103,'name'=>'BORDA DE REQUEIJÃO','price'=>0],
                ['id'=>1104,'name'=>'BORDA DE CHEDDAR','price'=>0],
                ['id'=>1105,'name'=>'BORDA DE CHOCOLATE BRANCO','price'=>0],
                ['id'=>1106,'name'=>'BORDA DE CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 12, 'name' => 'ESCOLHA SEU SABOR', 'max' => 2,
            'items' => [
                ['id'=>1201,'name'=>'FRANGO','price'=>0],
                ['id'=>1202,'name'=>'FRANGO COM CATUPIRY','price'=>0],
                ['id'=>1203,'name'=>'CALABRESA ACEBOLADA','price'=>0],
                ['id'=>1204,'name'=>'CALABRESA MOÍDA','price'=>0],
                ['id'=>1205,'name'=>'PORTUGUESA','price'=>0],
                ['id'=>1206,'name'=>'MUSSARELA','price'=>0],
                ['id'=>1207,'name'=>'PEPPERONI','price'=>0],
                ['id'=>1208,'name'=>'4 QUEIJOS','price'=>0],
                ['id'=>1209,'name'=>'MARGUERITA','price'=>0],
                ['id'=>1210,'name'=>'BACON','price'=>0],
                ['id'=>1211,'name'=>'CARNE SECA COM CATUPIRY','price'=>0],
                ['id'=>1212,'name'=>'CAMARÃO','price'=>3.90],
                ['id'=>1213,'name'=>'BACON DEFUMADO ESPECIAL','price'=>2.90],
                ['id'=>1214,'name'=>'CARNE DE SOL DESFIADA','price'=>3.90],
                ['id'=>1215,'name'=>'CHOCOLATE','price'=>0],
                ['id'=>1216,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>1217,'name'=>'BANANA COM CHOCOLATE','price'=>0],
                ['id'=>1218,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>1219,'name'=>'DOCE DE LEITE COM BANANA','price'=>0],
                ['id'=>1220,'name'=>'BANANA NEVADA','price'=>0],
            ]
        ],
    ],
    159 => [
        [
            'id' => 13, 'name' => 'ESCOLHA SUA BORDA', 'max' => 1,
            'items' => [
                ['id'=>1301,'name'=>'SEM BORDA RECHEADA','price'=>0],
                ['id'=>1302,'name'=>'BORDA DE CATUPIRY (ORIGINAL)','price'=>0],
                ['id'=>1303,'name'=>'BORDA DE REQUEIJÃO','price'=>0],
                ['id'=>1304,'name'=>'BORDA DE CHEDDAR','price'=>0],
                ['id'=>1305,'name'=>'BORDA DE CHOCOLATE BRANCO','price'=>0],
                ['id'=>1306,'name'=>'BORDA DE CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 14, 'name' => 'ESCOLHA SEU SABOR', 'max' => 2,
            'items' => [
                ['id'=>1401,'name'=>'FRANGO','price'=>0],
                ['id'=>1402,'name'=>'FRANGO COM CATUPIRY','price'=>0],
                ['id'=>1403,'name'=>'CALABRESA ACEBOLADA','price'=>0],
                ['id'=>1404,'name'=>'CALABRESA MOÍDA','price'=>0],
                ['id'=>1405,'name'=>'PORTUGUESA','price'=>0],
                ['id'=>1406,'name'=>'MUSSARELA','price'=>0],
                ['id'=>1407,'name'=>'PEPPERONI','price'=>0],
                ['id'=>1408,'name'=>'4 QUEIJOS','price'=>0],
                ['id'=>1409,'name'=>'MARGUERITA','price'=>0],
                ['id'=>1410,'name'=>'BACON','price'=>0],
                ['id'=>1411,'name'=>'CARNE SECA COM CATUPIRY','price'=>0],
                ['id'=>1412,'name'=>'CAMARÃO','price'=>3.90],
                ['id'=>1413,'name'=>'BACON DEFUMADO ESPECIAL','price'=>2.90],
                ['id'=>1414,'name'=>'CARNE DE SOL DESFIADA','price'=>3.90],
                ['id'=>1415,'name'=>'CHOCOLATE','price'=>0],
                ['id'=>1416,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>1417,'name'=>'BANANA COM CHOCOLATE','price'=>0],
                ['id'=>1418,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>1419,'name'=>'DOCE DE LEITE COM BANANA','price'=>0],
                ['id'=>1420,'name'=>'BANANA NEVADA','price'=>0],
            ]
        ],
    ],
    160 => [
        [
            'id' => 15, 'name' => 'ESCOLHA SUA BORDA', 'max' => 1,
            'items' => [
                ['id'=>1501,'name'=>'SEM BORDA RECHEADA','price'=>0],
                ['id'=>1502,'name'=>'BORDA DE CATUPIRY (ORIGINAL)','price'=>0],
                ['id'=>1503,'name'=>'BORDA DE REQUEIJÃO','price'=>0],
                ['id'=>1504,'name'=>'BORDA DE CHEDDAR','price'=>0],
                ['id'=>1505,'name'=>'BORDA DE CHOCOLATE BRANCO','price'=>0],
                ['id'=>1506,'name'=>'BORDA DE CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 16, 'name' => 'ESCOLHA SEU SABOR', 'max' => 2,
            'items' => [
                ['id'=>1601,'name'=>'FRANGO','price'=>0],
                ['id'=>1602,'name'=>'FRANGO COM CATUPIRY','price'=>0],
                ['id'=>1603,'name'=>'CALABRESA ACEBOLADA','price'=>0],
                ['id'=>1604,'name'=>'CALABRESA MOÍDA','price'=>0],
                ['id'=>1605,'name'=>'PORTUGUESA','price'=>0],
                ['id'=>1606,'name'=>'MUSSARELA','price'=>0],
                ['id'=>1607,'name'=>'PEPPERONI','price'=>0],
                ['id'=>1608,'name'=>'4 QUEIJOS','price'=>0],
                ['id'=>1609,'name'=>'MARGUERITA','price'=>0],
                ['id'=>1610,'name'=>'BACON','price'=>0],
                ['id'=>1611,'name'=>'CARNE SECA COM CATUPIRY','price'=>0],
                ['id'=>1612,'name'=>'CAMARÃO','price'=>3.90],
                ['id'=>1613,'name'=>'BACON DEFUMADO ESPECIAL','price'=>2.90],
                ['id'=>1614,'name'=>'CARNE DE SOL DESFIADA','price'=>3.90],
                ['id'=>1615,'name'=>'CHOCOLATE','price'=>0],
                ['id'=>1616,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>1617,'name'=>'BANANA COM CHOCOLATE','price'=>0],
                ['id'=>1618,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>1619,'name'=>'DOCE DE LEITE COM BANANA','price'=>0],
                ['id'=>1620,'name'=>'BANANA NEVADA','price'=>0],
            ]
        ],
    ],
    161 => [
        [
            'id' => 17, 'name' => 'ESCOLHA SUA BORDA', 'max' => 1,
            'items' => [
                ['id'=>1701,'name'=>'SEM BORDA RECHEADA','price'=>0],
                ['id'=>1702,'name'=>'BORDA DE CATUPIRY (ORIGINAL)','price'=>0],
                ['id'=>1703,'name'=>'BORDA DE REQUEIJÃO','price'=>0],
                ['id'=>1704,'name'=>'BORDA DE CHEDDAR','price'=>0],
                ['id'=>1705,'name'=>'BORDA DE CHOCOLATE BRANCO','price'=>0],
                ['id'=>1706,'name'=>'BORDA DE CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 18, 'name' => 'ESCOLHA SEU SABOR', 'max' => 2,
            'items' => [
                ['id'=>1801,'name'=>'FRANGO','price'=>0],
                ['id'=>1802,'name'=>'FRANGO COM CATUPIRY','price'=>0],
                ['id'=>1803,'name'=>'CALABRESA ACEBOLADA','price'=>0],
                ['id'=>1804,'name'=>'CALABRESA MOÍDA','price'=>0],
                ['id'=>1805,'name'=>'PORTUGUESA','price'=>0],
                ['id'=>1806,'name'=>'MUSSARELA','price'=>0],
                ['id'=>1807,'name'=>'PEPPERONI','price'=>0],
                ['id'=>1808,'name'=>'4 QUEIJOS','price'=>0],
                ['id'=>1809,'name'=>'MARGUERITA','price'=>0],
                ['id'=>1810,'name'=>'BACON','price'=>0],
                ['id'=>1811,'name'=>'CARNE SECA COM CATUPIRY','price'=>0],
                ['id'=>1812,'name'=>'CAMARÃO','price'=>3.90],
                ['id'=>1813,'name'=>'BACON DEFUMADO ESPECIAL','price'=>2.90],
                ['id'=>1814,'name'=>'CARNE DE SOL DESFIADA','price'=>3.90],
                ['id'=>1815,'name'=>'CHOCOLATE','price'=>0],
                ['id'=>1816,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>1817,'name'=>'BANANA COM CHOCOLATE','price'=>0],
                ['id'=>1818,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>1819,'name'=>'DOCE DE LEITE COM BANANA','price'=>0],
                ['id'=>1820,'name'=>'BANANA NEVADA','price'=>0],
            ]
        ],
    ],
    162 => [
        [
            'id' => 19, 'name' => 'ESCOLHA SUAS ESFIRRAS', 'max' => 5,
            'items' => [
                ['id'=>1901,'name'=>'CARNE DE SOL','price'=>0],
                ['id'=>1902,'name'=>'FRANGO','price'=>0],
                ['id'=>1903,'name'=>'FRANGO COM REQUEIJÃO','price'=>0],
                ['id'=>1904,'name'=>'QUEIJO','price'=>0],
                ['id'=>1905,'name'=>'CALABRESA COM QUEIJO','price'=>0],
                ['id'=>1906,'name'=>'CARNE COM QUEIJO','price'=>0],
                ['id'=>1907,'name'=>'CHOCOLATE','price'=>0],
                ['id'=>1908,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>1909,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>1910,'name'=>'BANANA COM CHOCOLATE','price'=>0],
            ]
        ],
    ],
    163 => [
        [
            'id' => 20, 'name' => 'ESCOLHA SUAS ESFIRRAS', 'max' => 5,
            'items' => [
                ['id'=>2001,'name'=>'CARNE DE SOL','price'=>0],
                ['id'=>2002,'name'=>'FRANGO','price'=>0],
                ['id'=>2003,'name'=>'FRANGO COM REQUEIJÃO','price'=>0],
                ['id'=>2004,'name'=>'QUEIJO','price'=>0],
                ['id'=>2005,'name'=>'CALABRESA COM QUEIJO','price'=>0],
                ['id'=>2006,'name'=>'CARNE COM QUEIJO','price'=>0],
                ['id'=>2007,'name'=>'CHOCOLATE','price'=>0],
                ['id'=>2008,'name'=>'CHOCOLATE COM MORANGO','price'=>0],
                ['id'=>2009,'name'=>'DOCE DE LEITE','price'=>0],
                ['id'=>2010,'name'=>'BANANA COM CHOCOLATE','price'=>0],
            ]
        ],
        [
            'id' => 21, 'name' => 'ESCOLHA SEU REFRIGERANTE', 'max' => 1,
            'items' => [
                ['id'=>2101,'name'=>'COCA COLA','price'=>0],
                ['id'=>2102,'name'=>'COCA COLA ZERO','price'=>0],
                ['id'=>2103,'name'=>'FANTA LARANJA','price'=>0],
                ['id'=>2104,'name'=>'GUARANÁ','price'=>0],
            ]
        ],
    ],
];

$product = $products[$id] ?? $products[155];
$cats = $categories[$id] ?? [];

echo json_encode([
    'product' => $product,
    'categories' => $cats
]);