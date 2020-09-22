<div>
    <?php
    foreach ($role_data as $key => $value) {
        ?>
        <div class="col-md-12" style="padding: 3px;">
            <div class="col-md-3 col-md-offset-1">
                <label class="checkbox-inline i-checks">
                    <input class="selectmodule" type="checkbox" name="selectmodule[]" value="<?= $key; ?>" <?= (($value[0] == 1) ? 'checked' : ''); ?>  id="selectmodule_<?= $key; ?>"><i></i> 
                </label>
                <label for="selectmodule_<?= $key; ?>" style="cursor: pointer;vertical-align: sub;"><?= $this->common->getModuleData('module_name', $key); ?></label>
            </div>
            <div class="col-md-7">
                <?php foreach ($value[1] as $key1 => $value1): ?>
                    <label class="checkbox-inline i-checks">
                        <input type="checkbox" class="selectpermission_<?php echo $key; ?>" name="selectpermission_<?php echo $key; ?>[]"  value="<?php echo $value1[0]; ?>" <?php echo (($value1[1] == 1) ? 'checked' : ''); ?> style="opacity: 1;" id="selectpermission_<?php echo $value1[0]; ?>"/><i></i> <?php echo $this->common->getPermissionData('Label', $value1[0]); ?> &nbsp; &nbsp;
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }
    ?>
</div>