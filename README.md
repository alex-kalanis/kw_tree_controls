# kw_tree_controls

![Build Status](https://github.com/alex-kalanis/kw_tree_controls/actions/workflows/code_checks.yml/badge.svg)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alex-kalanis/kw_tree_controls/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alex-kalanis/kw_tree_controls/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/alex-kalanis/kw_tree_controls/v/stable.svg?v=1)](https://packagist.org/packages/alex-kalanis/kw_tree_controls)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)
[![Downloads](https://img.shields.io/packagist/dt/alex-kalanis/kw_tree_controls.svg?v1)](https://packagist.org/packages/alex-kalanis/kw_tree_controls)
[![License](https://poser.pugx.org/alex-kalanis/kw_tree_controls/license.svg?v=1)](https://packagist.org/packages/alex-kalanis/kw_tree_controls)
[![Code Coverage](https://scrutinizer-ci.com/g/alex-kalanis/kw_tree_controls/badges/coverage.png?b=master&v=1)](https://scrutinizer-ci.com/g/alex-kalanis/kw_tree_controls/?branch=master)

Controls created from tree structure from source. For your own styles you need
to wrap them into some element which will allow you to style them with current
classes or you need to extend current classes and write them on your own.

## PHP Installation

```bash
composer.phar require alex-kalanis/kw_tree_controls
```

(Refer to [Composer Documentation](https://github.com/composer/composer/blob/master/doc/00-intro.md#introduction) if you are not
familiar with composer)


## PHP Usage

1.) Use your autoloader (if not already done via Composer autoloader)

2.) Add some external packages with connection to the local or remote services.

3.) Connect controls in  "kalanis\kw_tree_controls\Controls" into your app. Extends it for setting your case.

4.) Connect the "kalanis\kw_tree_controls\TWhereDir" into your app for storing the currently known path.

5.) Just call setting and render
