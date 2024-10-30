<?php
if (!defined('ABSPATH'))
	exit;
?>
<?php
$amo_leads_count = get_option("amo_leads_count");
?>
<h2>Список лидов</h2>
<table class="wp-list-table widefat fixed striped users">

    <thead>

    <tr>
        <th class="column-primary">
            #
        </th>
        <th class="column-primary">
            Имя
        </th>
        <th class="column-primary">
            Телефон
        </th>
        <th class="column-primary">
            Email
        </th>
        <th class="column-primary">
            Название товара/услуги
        </th>
    </tr>

    </thead>

    <tbody>
    <tr>

    </tr>
    </tbody>

</table>
<p>Количество лидов: <?=$amo_leads_count?></p>
<p>Перейдите в настройки плагина, введите параметры для интеграции с AMO.CRM</p>
