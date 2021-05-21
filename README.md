# Motivo Pre-Commit hooks

A set of [pre-commit][] hooks we found useful.

[pre-commit]: https://pre-commit.com/

## Description

This repository contains various pre-commit hooks we're just starting to collect.

## License

[MIT](./LICENSE.md)

### `add-ticket-to-commit`

We use Jira for our ticket management, and our branches usually follow the `feature/proj-103-short-description` method.
This command adds the commit message to the start of the commit.

The code is inspired on the work of [Wiktor Malinowski][1]'s article "[How To Prefix Your Commit Message With a Ticket Number Automatically][2]",
but with some changes to suit our programming style.

To install this, add the following to your repository's `.pre-commit-config.yaml`

```yaml
repos:
  # …
  - repo: https://github.com/motivozwolle/pre-commit-hooks
    hooks:
      - id: add-ticket-to-commit
```

[1]: https://medium.com/@abuduba
[2]: https://betterprogramming.pub/how-to-automatically-add-the-ticket-number-in-git-commit-message-bda5426ded05

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
