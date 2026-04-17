# TODO: Fix ERR_TOO_MANY_REDIRECTS (Redirect Loop)

## Plan Breakdown (Single 'web' guard + role middleware)
- [x] Step 1: Update config/auth.php - Simplify to single 'web' guard, remove role-specific guards
- [x] Step 3: Fix AuthenticatedSessionController.php - Remove role-specific guard login
- [x] Step 4: Fix AdminAuthController.php - Use default auth() login
- [x] Step 2: Update routes/web.php - Replace auth:role guards with auth + role:role middleware
- [x] Step 5: Simplify RoleSwitchController.php - Remove guard switching
- [x] Step 6: Remove/Delete MultiRoleAuthMiddleware.php and related services
- [x] Step 7: Verify/clean RoleMiddleware.php and RoleSessionMiddleware.php
- [x] Step 8: Clear caches (config:clear, route:clear, cache:clear)
- [ ] Step 9: Test login flows (user/employer/admin), access dashboards
- [ ] Step 10: Remove this TODO and update main TODO.md

**Current progress: Starting Step 1**

