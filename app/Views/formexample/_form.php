<?php /** @var array $errors */ ?>
<form method="post" action="<?= $action ?>">
    <?= csrf_field() ?>

    <div class="row">
        <div class="form-group col-md-3">
            <label class="form-label">Province</label>
            <select name="province_id" id="province_id" class="form-control">
                <option value="">-- Sélectionner --</option>
                <?php foreach ($provinces as $p): ?>
                    <option value="<?= $p['PROVINCE_ID'] ?>" <?= set_select('province_id', $p['PROVINCE_ID'], (isset($membre) && ($membre['province_id'] ?? '') == $p['PROVINCE_ID'])) ?>><?= esc($p['PROVINCE_NAME']) ?></option>
                <?php endforeach ?>
            </select>
            <?php if (isset($errors['province_id'])): ?><div class="text-danger"><?= $errors['province_id'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">Commune</label>
            <select name="commune_id" id="commune_id" class="form-control">
                <option value="">-- Sélectionner --</option>
                <?php if (! empty($communes ?? null)): foreach($communes as $c): ?>
                    <option value="<?= $c['COMMUNE_ID'] ?>" <?= set_select('commune_id', $c['COMMUNE_ID'], (isset($membre) && ($membre['commune_id'] ?? '') == $c['COMMUNE_ID'])) ?>><?= esc($c['COMMUNE_NAME']) ?></option>
                <?php endforeach; endif ?>
            </select>
            <?php if (isset($errors['commune_id'])): ?><div class="text-danger"><?= $errors['commune_id'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">Zone</label>
            <select name="zone_id" id="zone_id" class="form-control">
                <option value="">-- Sélectionner --</option>
                <?php if (! empty($zones ?? null)): foreach($zones as $z): ?>
                    <option value="<?= $z['ZONE_ID'] ?>" <?= set_select('zone_id', $z['ZONE_ID'], (isset($membre) && ($membre['zone_id'] ?? '') == $z['ZONE_ID'])) ?>><?= esc($z['ZONE_NAME']) ?></option>
                <?php endforeach; endif ?>
            </select>
            <?php if (isset($errors['zone_id'])): ?><div class="text-danger"><?= $errors['zone_id'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">Colline</label>
            <select name="colline_id" id="colline_id" class="form-control">
                <option value="">-- Sélectionner --</option>
                <?php if (! empty($collines ?? null)): foreach($collines as $co): ?>
                    <option value="<?= $co['COLLINE_ID'] ?>" <?= set_select('colline_id', $co['COLLINE_ID'], (isset($membre) && ($membre['COLLINE_ID'] ?? '') == $co['COLLINE_ID'])) ?>><?= esc($co['COLLINE_NAME']) ?></option>
                <?php endforeach; endif ?>
            </select>
            <?php if (isset($errors['colline_id'])): ?><div class="text-danger"><?= $errors['colline_id'] ?></div><?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label class="form-label">Nombre de groupes fonctionnels</label>
            <input type="number" min="0" name="nb_groupe_fonctionnels" class="form-control" value="<?= set_value('nb_groupe_fonctionnels', $membre['NB_GROUPE_FONCTIONNELS'] ?? '') ?>">
            <?php if (isset($errors['nb_groupe_fonctionnels'])): ?><div class="text-danger"><?= $errors['nb_groupe_fonctionnels'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">Nombre de membres inscrits</label>
            <input type="number" min="0" name="nb_membre_inscrits" class="form-control" value="<?= set_value('nb_membre_inscrits', $membre['NB_MEMBRE_INSCRITS'] ?? '') ?>">
            <?php if (isset($errors['nb_membre_inscrits'])): ?><div class="text-danger"><?= $errors['nb_membre_inscrits'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">Nombre d'hommes</label>
            <input type="number" min="0" name="nombre_homme" class="form-control" value="<?= set_value('nombre_homme', $membre['NOMBRE_HOMME'] ?? '') ?>">
            <?php if (isset($errors['nombre_homme'])): ?><div class="text-danger"><?= $errors['nombre_homme'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">Nombre de femmes</label>
            <input type="number" min="0" name="nombre_femme" class="form-control" value="<?= set_value('nombre_femme', $membre['NOMBRE_FEMME'] ?? '') ?>">
            <?php if (isset($errors['nombre_femme'])): ?><div class="text-danger"><?= $errors['nombre_femme'] ?></div><?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label class="form-label">Nombre de groupes</label>
            <input type="number" min="0" name="nb_groupe" class="form-control" value="<?= set_value('nb_groupe', $membre['NB_GROUPE'] ?? '') ?>">
            <?php if (isset($errors['nb_groupe'])): ?><div class="text-danger"><?= $errors['nb_groupe'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-6">
            <label class="form-label">Type de groupe</label>
            <select name="id_type_groupe" id="id_type_groupe" class="form-control">
                <option value="">-- Sélectionner --</option>
                <?php if (! empty($typeGroupes ?? null)): foreach($typeGroupes as $tg): ?>
                    <option value="<?= $tg['ID_TYPE_GROUPE'] ?>" <?= set_select('id_type_groupe', $tg['ID_TYPE_GROUPE'], (isset($membre) && ($membre['ID_TYPE_GROUPE'] ?? '') == $tg['ID_TYPE_GROUPE'])) ?>><?= esc($tg['DESC_GROUPE']) ?></option>
                <?php endforeach; endif ?>
            </select>
            <?php if (isset($errors['id_type_groupe'])): ?><div class="text-danger"><?= $errors['id_type_groupe'] ?></div><?php endif ?>
        </div>
    </div>

    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-success"><?= $buttonText ?? 'Enregistrer' ?></button>
        <a href="<?= site_url('formexample') ?>" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<script>
document.addEventListener('change', function(e){
    if (e.target && e.target.id==='province_id') {
        fetch('<?= site_url('formexample/getCommunes/') ?>'+e.target.value)
            .then(r=>r.json()).then(data=>{
                const sel = document.getElementById('commune_id'); sel.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(function(it){ sel.innerHTML += '<option value="'+it.COMMUNE_ID+'">'+it.COMMUNE_NAME+'</option>' });
            });
    }

    if (e.target && e.target.id==='commune_id') {
        fetch('<?= site_url('formexample/getZones/') ?>'+e.target.value)
            .then(r=>r.json()).then(data=>{
                const sel = document.getElementById('zone_id'); sel.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(function(it){ sel.innerHTML += '<option value="'+it.ZONE_ID+'">'+it.ZONE_NAME+'</option>' });
            });
    }

    if (e.target && e.target.id==='zone_id') {
        fetch('<?= site_url('formexample/getCollines/') ?>'+e.target.value)
            .then(r=>r.json()).then(data=>{
                const sel = document.getElementById('colline_id'); sel.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(function(it){ sel.innerHTML += '<option value="'+it.COLLINE_ID+'">'+it.COLLINE_NAME+'</option>' });
            });
    }
});
</script>