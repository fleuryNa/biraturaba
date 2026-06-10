<?php /** @var array $errors */ ?>
<form method="post" action="<?= $action ?>">
    <?= csrf_field() ?>

<?php if (isset($errors['somme'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-triangle"></i> 
        <?= $errors['somme'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>

    <div class="row">
        <div class="form-group col-md-3">
            <label class="form-label">
                <span class="text-danger">*</span> Province
            </label>
            <select name="province_id" id="province_id" class="form-control <?= isset($errors['province_id']) ? 'is-invalid' : '' ?>">
                <option value="">-- Sélectionner --</option>
                <?php foreach ($provinces as $p): ?>
                    <option value="<?= $p['PROVINCE_ID'] ?>" <?= set_select('province_id', $p['PROVINCE_ID'], (isset($membre) && ($membre['province_id'] ?? '') == $p['PROVINCE_ID'])) ?>><?= esc($p['PROVINCE_NAME']) ?></option>
                <?php endforeach ?>
            </select>
            <?php if (isset($errors['province_id'])): ?><div class="text-danger small mt-1"><?= $errors['province_id'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">
                <span class="text-danger">*</span> Commune
            </label>
            <select name="commune_id" id="commune_id" class="form-control <?= isset($errors['commune_id']) ? 'is-invalid' : '' ?>">
                <option value="">-- Sélectionner --</option>
                <?php if (! empty($communes ?? null)): foreach($communes as $c): ?>
                    <option value="<?= $c['COMMUNE_ID'] ?>" <?= set_select('commune_id', $c['COMMUNE_ID'], (isset($membre) && ($membre['commune_id'] ?? '') == $c['COMMUNE_ID'])) ?>><?= esc($c['COMMUNE_NAME']) ?></option>
                <?php endforeach; endif ?>
            </select>
            <?php if (isset($errors['commune_id'])): ?><div class="text-danger small mt-1"><?= $errors['commune_id'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">
                <span class="text-danger">*</span> Zone
            </label>
            <select name="zone_id" id="zone_id" class="form-control <?= isset($errors['zone_id']) ? 'is-invalid' : '' ?>">
                <option value="">-- Sélectionner --</option>
                <?php if (! empty($zones ?? null)): foreach($zones as $z): ?>
                    <option value="<?= $z['ZONE_ID'] ?>" <?= set_select('zone_id', $z['ZONE_ID'], (isset($membre) && ($membre['zone_id'] ?? '') == $z['ZONE_ID'])) ?>><?= esc($z['ZONE_NAME']) ?></option>
                <?php endforeach; endif ?>
            </select>
            <?php if (isset($errors['zone_id'])): ?><div class="text-danger small mt-1"><?= $errors['zone_id'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-3">
            <label class="form-label">
                <span class="text-danger">*</span> Colline
            </label>
            <select name="colline_id" id="colline_id" class="form-control <?= isset($errors['colline_id']) ? 'is-invalid' : '' ?>">
                <option value="">-- Sélectionner --</option>
                <?php if (! empty($collines ?? null)): foreach($collines as $co): ?>
                    <option value="<?= $co['COLLINE_ID'] ?>" <?= set_select('colline_id', $co['COLLINE_ID'], (isset($membre) && ($membre['COLLINE_ID'] ?? '') == $co['COLLINE_ID'])) ?>><?= esc($co['COLLINE_NAME']) ?></option>
                <?php endforeach; endif ?>
            </select>
            <?php if (isset($errors['colline_id'])): ?><div class="text-danger small mt-1"><?= $errors['colline_id'] ?></div><?php endif ?>
        </div>
    </div>

    <!-- CHAMP DESCRIPTION OBLIGATOIRE -->
    <div class="row">
        <div class="form-group col-md-12">
            <label class="form-label">
                <span class="text-danger">*</span> Description
            </label>
            <textarea 
                name="description" 
                class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" 
                rows="4" 
                placeholder="Saisissez une description (minimum 10 caractères)..."><?= set_value('description', $membre['DESCRIPTION'] ?? '') ?></textarea>
            <?php if (isset($errors['description'])): ?>
                <div class="text-danger small mt-1"><?= $errors['description'] ?></div>
            <?php else: ?>
                <small class="form-text text-muted">La description est obligatoire et doit contenir au moins 10 caractères.</small>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label class="form-label">
                <span class="text-danger">*</span> Membres inscrits
            </label>
            <input 
                type="number" 
                min="0" 
                name="nb_membre_inscrits" 
                class="form-control <?= isset($errors['nb_membre_inscrits']) ? 'is-invalid' : '' ?>" 
                value="<?= set_value('nb_membre_inscrits', $membre['NB_MEMBRE_INSCRITS'] ?? '') ?>"
                placeholder="Ex: 100">
            <?php if (isset($errors['nb_membre_inscrits'])): ?><div class="text-danger small mt-1"><?= $errors['nb_membre_inscrits'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-4">
            <label class="form-label">
                <span class="text-danger">*</span> Hommes
            </label>
            <input 
                type="number" 
                min="0" 
                name="nombre_homme" 
                class="form-control <?= isset($errors['nombre_homme']) ? 'is-invalid' : '' ?>" 
                value="<?= set_value('nombre_homme', $membre['NOMBRE_HOMME'] ?? '') ?>"
                placeholder="Ex: 45">
            <?php if (isset($errors['nombre_homme'])): ?><div class="text-danger small mt-1"><?= $errors['nombre_homme'] ?></div><?php endif ?>
        </div>

        <div class="form-group col-md-4">
            <label class="form-label">
                <span class="text-danger">*</span> Femmes
            </label>
            <input 
                type="number" 
                min="0" 
                name="nombre_femme" 
                class="form-control <?= isset($errors['nombre_femme']) ? 'is-invalid' : '' ?>" 
                value="<?= set_value('nombre_femme', $membre['NOMBRE_FEMME'] ?? '') ?>"
                placeholder="Ex: 55">
            <?php if (isset($errors['nombre_femme'])): ?><div class="text-danger small mt-1"><?= $errors['nombre_femme'] ?></div><?php endif ?>
        </div>
    </div>

   <div class="row">
    <div class="form-group col-md-6">
        <label class="form-label">
            <span class="text-danger">*</span> Structures
        </label>
        <input 
            type="number" 
            min="0" 
            name="nb_groupe" 
            class="form-control <?= isset($errors['nb_groupe']) ? 'is-invalid' : '' ?>" 
            value="<?= set_value('nb_groupe', $membre['NB_GROUPE'] ?? '') ?>"
            placeholder="Ex: 10">
        <?php if (isset($errors['nb_groupe'])): ?><div class="text-danger small mt-1"><?= $errors['nb_groupe'] ?></div><?php endif ?>
    </div>

    <div class="form-group col-md-6">
        <label class="form-label">
            <span class="text-danger">*</span> Type de structures
        </label>
        <select name="id_type_groupe" id="id_type_groupe" class="form-control <?= isset($errors['id_type_groupe']) ? 'is-invalid' : '' ?>">
            <option value="">-- Sélectionner --</option>
            <?php if (! empty($typeGroupes ?? null)): foreach($typeGroupes as $tg): ?>
                <option value="<?= $tg['ID_TYPE_GROUPE'] ?>" <?= set_select('id_type_groupe', $tg['ID_TYPE_GROUPE'], (isset($membre) && ($membre['ID_TYPE_GROUPE'] ?? '') == $tg['ID_TYPE_GROUPE'])) ?>><?= esc($tg['DESC_GROUPE']) ?></option>
            <?php endforeach; endif ?>
        </select>
        <?php if (isset($errors['id_type_groupe'])): ?><div class="text-danger small mt-1"><?= $errors['id_type_groupe'] ?></div><?php endif ?>
    </div>
</div>
    <div class="row">
        <div class="form-group col-md-12">
            <hr>
            <div class="alert alert-info small">
                <i class="fa fa-info-circle"></i> 
                Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.
                <br><i class="fa fa-calculator"></i> 
                Le nombre total de membres inscrits doit être égal à la somme des hommes et des femmes.
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> <?= $buttonText ?? 'Enregistrer' ?>
            </button>
            <a href="<?= site_url('formexample') ?>" class="btn btn-secondary">
                <i class="fa fa-times"></i> Annuler
            </a>
        </div>
    </div>
</form>

<script>
document.addEventListener('change', function(e){
    if (e.target && e.target.id==='province_id') {
        fetch('<?= site_url('formexample/getCommunes/') ?>'+e.target.value)
            .then(r=>r.json()).then(data=>{
                const sel = document.getElementById('commune_id'); 
                sel.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(function(it){ 
                    sel.innerHTML += '<option value="'+it.COMMUNE_ID+'">'+it.COMMUNE_NAME+'</option>' 
                });
                // Réinitialiser les selects dépendants
                document.getElementById('zone_id').innerHTML = '<option value="">-- Sélectionner --</option>';
                document.getElementById('colline_id').innerHTML = '<option value="">-- Sélectionner --</option>';
            });
    }

    if (e.target && e.target.id==='commune_id') {
        fetch('<?= site_url('formexample/getZones/') ?>'+e.target.value)
            .then(r=>r.json()).then(data=>{
                const sel = document.getElementById('zone_id'); 
                sel.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(function(it){ 
                    sel.innerHTML += '<option value="'+it.ZONE_ID+'">'+it.ZONE_NAME+'</option>' 
                });
                // Réinitialiser la colline
                document.getElementById('colline_id').innerHTML = '<option value="">-- Sélectionner --</option>';
            });
    }

    if (e.target && e.target.id==='zone_id') {
        fetch('<?= site_url('formexample/getCollines/') ?>'+e.target.value)
            .then(r=>r.json()).then(data=>{
                const sel = document.getElementById('colline_id'); 
                sel.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(function(it){ 
                    sel.innerHTML += '<option value="'+it.COLLINE_ID+'">'+it.COLLINE_NAME+'</option>' 
                });
            });
    }
});

// Validation côté client optionnelle avant soumission
document.querySelector('form').addEventListener('submit', function(e) {
    let hasError = false;
    const requiredFields = [
        'province_id', 'commune_id', 'zone_id', 'colline_id', 
        'description', 'nb_membre_inscrits',
        'nombre_homme', 'nombre_femme', 'nb_groupe', 'id_type_groupe'
    ];
    
    requiredFields.forEach(function(fieldName) {
        const field = document.querySelector('[name="' + fieldName + '"]');
        if (field && !field.value) {
            hasError = true;
            field.classList.add('is-invalid');
        } else if (field) {
            field.classList.remove('is-invalid');
        }
    });
    
    if (hasError) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires (marqués par *)');
    }
});
</script>
<script type="text/javascript">
    // Validation en temps réel de la somme hommes + femmes = membres inscrits
document.addEventListener('DOMContentLoaded', function() {
    const hommesInput = document.querySelector('input[name="nombre_homme"]');
    const femmesInput = document.querySelector('input[name="nombre_femme"]');
    const membresInput = document.querySelector('input[name="nb_membre_inscrits"]');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-danger small mt-1';
    
    function validateSum() {
        const hommes = parseInt(hommesInput.value) || 0;
        const femmes = parseInt(femmesInput.value) || 0;
        const membres = parseInt(membresInput.value) || 0;
        const sum = hommes + femmes;
        
        // Supprimer l'ancien message d'erreur s'il existe
        if (errorDiv.parentNode) {
            errorDiv.remove();
        }
        
        if (membresInput.value && (sum !== membres)) {
            errorDiv.innerHTML = '<i class="fa fa-warning"></i> La somme des hommes et femmes (' + sum + ') doit être égale au nombre de membres inscrits (' + membres + ').';
            membresInput.parentNode.appendChild(errorDiv);
            membresInput.classList.add('is-invalid');
            return false;
        } else {
            membresInput.classList.remove('is-invalid');
            return true;
        }
    }
    
    if (hommesInput && femmesInput && membresInput) {
        hommesInput.addEventListener('input', validateSum);
        femmesInput.addEventListener('input', validateSum);
        membresInput.addEventListener('input', validateSum);
    }
});
</script>

<style>
    .form-label {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .text-danger {
        color: #dc3545 !important;
    }
    
    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .form-control:focus {
        box-shadow: none;
    }
    
    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .alert-info {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
        border-radius: 4px;
        padding: 8px 12px;
    }
    
    .alert-info i {
        margin-right: 5px;
    }
    
    .btn {
        margin-right: 5px;
    }
    
    .small {
        font-size: 0.875rem;
    }
    
    .mt-1 {
        margin-top: 0.25rem;
    }
</style>