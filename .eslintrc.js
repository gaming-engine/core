module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: [
    'plugin:vue/essential',
    'airbnb-base',
  ],
  parserOptions: {
    ecmaVersion: 12,
    sourceType: 'module',
  },
  plugins: [
    'vue',
    'prettier',
  ],
  rules: {
    'import/no-unresolved': 'off',
    'max-len': [
      'error',
      {
        code: 100,
        ignorePattern: 'd="([\\s\\S]*?)"',
      },
    ],

    'vue/max-len': [
      'error',
      {
        template: 100,
        ignorePattern: 'd="([\\s\\S]*?)"',
      },
    ],

    yoda: [2, 'always'],
  },
  overrides: [
    {
      files: [
        '**/*.spec.js',
        '**/*.spec.jsx',
      ],
      env: {
        jest: true,
      },
    },
  ],
};
