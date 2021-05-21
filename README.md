# Motivo Pre-Commit hooks

A set of [pre-commit][] hooks we found useful.

[pre-commit]: https://pre-commit.com/

## Description

This repository contains various pre-commit hooks we're just starting to collect.

## License

[MIT](./LICENSE.md)

## `shellcheck`

Checks the bash scripts in the repository against `shellcheck` for common errors.

To install this, add the following to your repository's `.pre-commit-config.yaml`

```yaml
repos:
  # …
  - repo: https://github.com/motivozwolle/pre-commit-hooks
    hooks:
      - id: shellcheck
```
