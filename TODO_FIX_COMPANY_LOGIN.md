# TODO: Fix Company Login (Paused/Activated)

Approved plan steps:

## ✅ 1. Update User model - add boolean cast for is_active
File: app/Models/User.php - DONE

## ✅ 2. Update RoleMiddleware - add isActive check for employer
File: app/Http/Middleware/RoleMiddleware.php - DONE

## ✅ 3. Clear caches & test
Caches cleared.

## ✅ 4. Verify: pause → no login (paused msg), active → login OK, wrong creds → generic error
Changes applied, ready for testing.

**COMPLETE ✅**

Progress: Starting implementation...

