# Contributing
Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/hbll-collection-development/omeka-s-any-cloud).

## Pull Requests
- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - Check the code style with ``$ composer check-style`` and fix it with ``$ composer fix-style``.
- **Document any change in behavior** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.
- **Consider our release cycle** - We try to follow [SemVer v2.0.0](http://semver.org/). Randomly breaking public APIs is not an option.
- **Create feature branches** - Don't ask us to pull from your master branch.
- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.
- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## Creating Releases
If you have access to create releases, please note the following:
- Releases are created automatically when you create a semantically versioned `tag` (**not** a release using the GitHub web interface)
- Before creating a `tag` please ensure the following:
  - `CHANGELOG.md` has been updated appropriately
  - `RELEASE.md` has been updated appropriately—the text of this file will be what is added to the release notes created by the `.github/workflows/release.yml` action. Often this will be the section of the `CHANGELOG.md` for this release but may include more information relevant to this release
  - `README.md` has been updated appropriately
  - `composer.lock` is correct—the GitHub action will use whatever version of dependencies in the lock file
  - `config/module.ini` has the correct version that matches the tag you wish to create

**Happy coding**!
