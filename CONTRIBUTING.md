# Contributing to Laravel Chat

Thank you for your interest in contributing to Laravel Chat! This document provides guidelines and instructions for contributing to this project. We love your input! We want to make contributing to Laravel Chat as easy and transparent as possible, whether it's:

- 🐛 Reporting a bug
- 💡 Discussing the current state of the code
- 🔧 Submitting a fix
- ✨ Proposing new features
- 📝 Becoming a maintainer

## Development Workflow

We use GitHub to host code, track issues and feature requests, as well as accept pull requests. We follow the [GitHub Flow](https://docs.github.com/en/get-started/quickstart/github-flow) for all code changes.

### Prerequisites

- PHP 8.2 or higher
- Composer
- Laravel 12.0 or higher
- Git

### Local Development Setup

1. Fork the repository
2. Clone your fork:
   ```bash
   git clone https://github.com/your-username/laravel-chat.git
   cd laravel-chat
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Create a new branch for your feature/fix:
   ```bash
   git checkout -b feature/your-feature-name
   ```

### Code Style and Standards

We follow PSR-12 coding standards and use Laravel Pint for code style enforcement. Before submitting your code:

1. Run code style fixer:
   ```bash
   composer format
   ```

2. Run static analysis:
   ```bash
   composer analyse
   ```

3. Run tests:
   ```bash
   composer test
   ```

### Making Changes

1. Make your changes
2. Add tests for new functionality
3. Update documentation if needed
4. Ensure all tests pass
5. Commit your changes following our commit message convention

### Commit Message Convention

We follow the [Conventional Commits](https://www.conventionalcommits.org/) specification. Commit messages should be structured as follows:

```
<type>(<scope>): <description>

[optional body]

[optional footer]
```

Types:
- `feat`: A new feature
- `fix`: A bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, etc)
- `refactor`: Code changes that neither fix bugs nor add features
- `perf`: Performance improvements
- `test`: Adding or fixing tests
- `chore`: Changes to build process or auxiliary tools
- `ci`: Changes to CI configuration

Example:
```
feat(auth): add support for custom participant models

- Add new trait for custom participant models
- Update documentation
- Add tests for new functionality

Closes #123
```

### Pull Request Process

1. Update the README.md with details of changes if needed
2. Update the CHANGELOG.md with a summary of your changes
3. Ensure all tests pass and code style checks are satisfied
4. The PR will be merged once you have the sign-off of at least one maintainer

### Testing

We use Pest PHP for testing. When adding new features or fixing bugs:

1. Write tests in the `tests` directory
2. Follow the existing test structure
3. Ensure all tests pass:
   ```bash
   composer test
   ```
4. For test coverage:
   ```bash
   composer test-coverage
   ```

### Documentation

- Update README.md if you're changing functionality
- Add PHPDoc blocks to new classes and methods
- Update API documentation if endpoints change
- Add examples for new features

### Reporting Bugs

We use GitHub issues to track public bugs. Report a bug by [opening a new issue](https://github.com/faraztanveer/laravel-chat/issues/new).

A good bug report should include:

- A clear and descriptive title
- Steps to reproduce the issue
- Expected behavior
- Actual behavior
- Environment details (PHP version, Laravel version, etc.)
- Any relevant code snippets or logs
- Screenshots if applicable

### Feature Requests

We love feature requests! To suggest a new feature:

1. [Open a new issue](https://github.com/faraztanveer/laravel-chat/issues/new)
2. Use the "Feature Request" template
3. Describe the feature and its benefits
4. Include any relevant examples or use cases

### Code of Conduct

Please be respectful and considerate of others when contributing to this project. We aim to foster an inclusive and welcoming community.

### License

By contributing to Laravel Chat, you agree that your contributions will be licensed under the project's MIT License. 
