module.exports = {
    'resources/**/*.{css}': ['prettier --write'],
    'resources/**/*.{js}': ['eslint --no-ignore --color', 'prettier --write'],
    '**/*.php': [
        'php ./vendor/bin/php-cs-fixer fix --config .php-cs-fixer.php --allow-risky=yes'
    ]
};
