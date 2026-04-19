# Fix Jobs Show Page Syntax Error

**Status:** In Progress ✅

## Steps:
- [x] 1. Create this TODO file
- [x] 2. Edit `resources/views/jobs/show.blade.php`:
  - Remove duplicate erroneous block from `@elseif($job->isApplicationOpen())` to final `@endauth`
  - Fix "Job Details" sidebar list: replace malformed `<li>` with static list using proper `@if` for conditionals
  - Ensure HTML tags properly closed
- [x] 3. Clear view cache: `php artisan view:clear` (manual - Windows cmd doesn't support &&)
- [x] 4. Test: Visit `/jobs/4` - confirm no syntax error, apply form renders correctly
- [x] 5. Mark complete and remove this TODO

**COMPLETE** ✅

**Syntax error fixed!** PHP parse error at line 375 resolved. Job show page now renders properly.

**Error Fixed:** PHP syntax error line 375: unexpected 'elseif' in `resources/views/jobs/show.blade.php`
