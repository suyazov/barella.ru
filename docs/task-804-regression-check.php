<?php

declare(strict_types=1);

function requireContract(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

$path = __DIR__ . '/../admin-direct/changes/task-issue-suyazov-barella-ru-804.json';
$changeSet = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
$pageOps = array_values(array_filter(
    $changeSet['ops'],
    static fn (array $op): bool => $op['type'] === 'update_page' && $op['page_id'] === 2471
));
requireContract(count($pageOps) === 1, 'Expected one homepage update_page operation.');

$elements = json_decode($pageOps[0]['elementor_data'], true, 512, JSON_THROW_ON_ERROR);
$sectionIds = array_column($elements, 'id');
$heroIndex = array_search('586e9156', $sectionIds, true);
$inlineIndex = array_search('6dab112c', $sectionIds, true);
requireContract(is_int($heroIndex) && is_int($inlineIndex) && $heroIndex < $inlineIndex, 'Hero must precede inline section.');

$inlineSection = $elements[$inlineIndex];
$inlineJson = json_encode($inlineSection, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
requireContract(substr_count($inlineJson, '[contact-form-7 id=\"2562\" title=\"Raschet\"]') === 1, 'Expected exactly one inline CF7 2562 widget.');
requireContract(str_contains($inlineSection['settings']['custom_css'], '.elementor-element-6dab112c .find-doctor-box'), 'Missing section-scoped visibility override.');
requireContract(!str_contains($inlineSection['settings']['custom_css'], 'body.home .elementor-element-6dab112c'), 'Invalid Elementor descendant selector remains.');

$objectsIndex = null;
foreach ($elements as $index => $element) {
    $json = json_encode($element, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    if (str_contains($json, 'Для каких объектов мы работаем')) {
        $objectsIndex = $index;
        break;
    }
}
requireContract(is_int($objectsIndex) && $inlineIndex < $objectsIndex, 'Inline section must precede objects section.');

$optionOps = array_values(array_filter(
    $changeSet['ops'],
    static fn (array $op): bool => $op['type'] === 'update_option'
        && $op['key'] === 'bridge_connector_cf7_modal_config'
));
requireContract(count($optionOps) === 1, 'Expected one modal option operation.');
$modalConfig = json_decode($optionOps[0]['value'], true, 512, JSON_THROW_ON_ERROR);
$formsByModal = array_column($modalConfig, 'form_id', 'id');
requireContract($formsByModal === ['callback' => 3334, 'calculation' => 2562], 'Modal form mapping changed unexpectedly.');

echo "TASK-804 regression check passed\n";
