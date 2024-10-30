<?php
if (!defined('ABSPATH'))
	exit;
?>
<?php
$amo_leads_settings = unserialize(get_option("amo_leads_settings"));
?>
<h2>Настройки</h2>

<form method="post" action="" novalidate="novalidate">

    <table class="form-table" role="presentation">

        <tbody>

        <tr>
            <th scope="row"><label for="url">URL Amo.CRM</label></th>
            <td><input name="url" type="text" id="url" value="<?=$amo_leads_settings['url']?>" class="regular-text">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="login">Логин Amo.CRM</label></th>
            <td><input name="login" type="text" id="login" value="" class="regular-text">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="user_hash">Кеш (Ключ АПИ)</label></th>
            <td><input name="user_hash" type="text" id="user_hash" value="<?=$amo_leads_settings['user_hash']?>" class="regular-text">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="description">Краткое описание</label></th>
            <td><input name="description" type="text" id="description" aria-describedby="tagline-description"
                       value="" class="regular-text">
                <p class="description" id="description">Краткое описание интеграции с AMO.CRM</p>
            </td>
        </tr>


        </tbody>
    </table>


    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary"
               value="Сохранить изменения">
    </p>
</form>