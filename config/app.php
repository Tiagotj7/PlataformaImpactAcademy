<?php
return [
  'base_path' => getenv('APP_BASE_PATH') ?: ($_ENV['APP_BASE_PATH'] ?? ''),
  'app_name'  => getenv('APP_NAME') ?: ($_ENV['APP_NAME'] ?? 'Impact Academy'),
  'timezone'  => getenv('APP_TIMEZONE') ?: ($_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo'),
];