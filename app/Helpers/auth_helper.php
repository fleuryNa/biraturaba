<?php

if (! function_exists('has_droit')) {
    function has_droit($idDroit): bool
    {
        $droits = session()->get('SUPERBAT_DROIT') ?? [];

        return in_array($idDroit, $droits);
    }
}