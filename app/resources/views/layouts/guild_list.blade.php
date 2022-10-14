<?php
if (isset($guild['active']) and $guild['active']):
    $active = ' active';
else:
    $active = '';
endif; ?>
<li class="guilds__guild<?= $active ?>">
    <a href="/guild/<?= $guild->id ?>">
        <h2 class="guilds__guild-name"><?= $guild['displayname'] ?></h2>
        <img class="guilds__guild-icon" src="<?= $guild['avatar_url'] ?>" alt="<?= $guild['name'] ?>">
    </a>
</li>
