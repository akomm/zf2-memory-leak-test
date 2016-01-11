# zf2-memory-leak-test

After verifying this against explicit `gc_collect_cycles()` calls, it is clear that:

 * the bug is not in PHP 7
 * the bug only affects PHP 5, which cannot detect complex cycles
 * zf2 is not actually leaking, but the complexity of the dependencies leads to leaks in older PHP engines

Therefore: UPGRADE.
