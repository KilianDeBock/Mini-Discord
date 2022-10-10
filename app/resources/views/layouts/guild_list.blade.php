<?php
if (array_key_exists("active", $guild) and $guild['active']):
    $active = ' active';
else:
    $active = '';
endif; ?>
<li class="guilds__guild<?= $active ?>">
    <h2 class="guilds__guild-name"><?= $guild['name'] ?></h2>
    <img class="guilds__guild-icon" src="<?= $guild['img'] ?>" alt="<?= $guild['name'] ?>">
</li>
