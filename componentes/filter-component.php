<?php
/**
 * Componente de Filtro Reutilizable
 * 
 * @param string $filterName - Nombre del filtro (ej: "Categorías")
 * @param array $filterValues - Array de valores (ej: ['Acción', 'RPG', 'Aventura'])
 * @param string $filterId - ID único para el filtro (ej: "categories-filter")
 * @param bool $collapsible - Si el filtro tiene chevron para expandir/contraer (default: false)
 * @param bool $checked - Si los checkboxes inician checked (default: false)
 */
function renderFilterGroup($filterName, $filterValues, $filterId, $collapsible = false, $checked = false) {
    $checkedAttr = $checked ? 'checked' : '';
    $checkboxId = $filterId . '-checkbox';
    
    echo '<div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 10px;">';
    echo '    <input type="checkbox" id="' . htmlspecialchars($checkboxId) . '" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);" ' . $checkedAttr . '>';
    echo '    <label for="' . htmlspecialchars($checkboxId) . '" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">' . htmlspecialchars($filterName) . '</label>';
    
    if ($collapsible) {
        echo '    <button style="width: 10px; height: 10px; border: none; background: none; cursor: pointer; color: var(--base-ink); padding: 0;">';
        echo '        <i class="bi bi-chevron-up" style="font-size: 8px;"></i>';
        echo '    </button>';
    }
    
    echo '</div>';
    
    // Si es expandible, mostramos los sub-valores
    if ($collapsible && is_array($filterValues) && count($filterValues) > 0) {
        echo '<div id="' . htmlspecialchars($filterId . '-values') . '" style="margin-left: 15px; display: none;">';
        foreach ($filterValues as $value) {
            $valueId = $filterId . '-' . preg_replace('/\s+/', '-', strtolower($value));
            echo '    <div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 5px;">';
            echo '        <input type="checkbox" id="' . htmlspecialchars($valueId) . '" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);">';
            echo '        <label for="' . htmlspecialchars($valueId) . '" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">' . htmlspecialchars($value) . '</label>';
            echo '    </div>';
        }
        echo '</div>';
    }
}
?>
