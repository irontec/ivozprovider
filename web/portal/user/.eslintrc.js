module.exports = {
    "parser": "@typescript-eslint/parser",
    "parserOptions": {
      "sourceType": "module"
    },
    "plugins": [
      "@typescript-eslint",
      "react-hooks",
      "prettier",
      "simple-import-sort",
      "import",
      "unused-imports"
    ],
    "extends": [
      "plugin:react/recommended",
      "plugin:@typescript-eslint/recommended",
      "plugin:prettier/recommended"
    ],
    "rules": {
      // good practises
      "camelcase": ["error", { properties: "never" }],
      "eqeqeq": "error",
      "new-cap": ["error", { capIsNew: false }],
      "no-console": ["error", { allow: ["error"] }],
      "no-else-return": ["error", { allowElseIf: false }],
      "no-extend-native": "error",
      "no-lonely-if": "error",
      "no-param-reassign": "error",
      "no-return-assign": "error",
      "no-throw-literal": "error",
      "no-var": "error",
      "object-shorthand": "off",
      "prefer-const": "error",
      "prefer-rest-params": "error",
      "prefer-spread": "error",
      "prefer-template": "error",
      "radix": "error",
      "yoda": "off",

      // style
      "curly": "error",
      "lines-between-class-members": ["error", "always", { exceptAfterSingleLine: true }],
      "padding-line-between-statements": [
        "error",
        { blankLine: "always", prev: "*", next: "return" },
      ],
      "prettier/prettier": [
        "error",
        {
          printWidth: 80,
          useTabs: false,
          tabWidth: 2,
          singleQuote: true,
          jsxSingleQuote: true,
          semi: true,
          arrowParens: "always",
          
        }
      ],

      // plugins
      "react-hooks/rules-of-hooks": "error",
      "react-hooks/exhaustive-deps": "warn",
      "react/react-in-jsx-scope": "off",
      "react/prop-types": "off",
      "@typescript-eslint/no-explicit-any": "error",
      "import/first": "error",
      "import/newline-after-import": "error",
      "import/no-duplicates": "error",
      "simple-import-sort/exports": "error",
      "simple-import-sort/imports": "error",
      "unused-imports/no-unused-imports": "error",
      "no-unused-vars": "off",
      "unused-imports/no-unused-vars": [
        "warn",
        {
          vars: "all",
          varsIgnorePattern: "^_",
          args: "after-used",
          argsIgnorePattern: "^_",
        },
      ],
    },
    "settings": {
      "react": {
        "pragma": "React",
        "version": "detect"
      }
    }
  }
  