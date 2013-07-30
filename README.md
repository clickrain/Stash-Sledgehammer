# Stash Sledgehammer

Clear the Stash cache whenever any entry is added, updated, or deleted.

## A note about support

While we have incentive to keep this project working because we use it, we are
not always available to provide support for Stash Sledgehammer. We therefore
offer it to you, free of charge, but with no guarantee of support. Find
something that's not working? Or could be improved? By all means, fix it!
Submit a pull request, and we'll pull it into the project so everyone can
benefit. But please, no hard feelings if we can't help you when it's not
working. Go forth and Open Source.

## Requirements

* EE 2.0
* PHP 5 >= 5.3

## Installation

1. Copy the "stash_sledgehammer" folder to ExpressionEngine's third-party add-
ons directory. (e.g. /system/expressionengine/third_party/)

## How it works

Stash Sledgehammer uses the ExpressionEngine hooks `delete_entries_start`,
`update_multi_entries_start`, and `entry_submission_absolute_end` to watch for
changes to entries. When one of these hooks is called, it deletes the entire
stash cache without any sort of rhyme, reason, or logic, like using a
sledgehammer to solve a problem. It does *not* call Stash's `stash_delete`
hook.
