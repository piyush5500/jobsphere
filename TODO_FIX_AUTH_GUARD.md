# TODO: Fix Auth Guard Error - Steps to Complete

## Plan Breakdown (Approved)

**✅ Step 1: Understand project** - Complete (single guard + role field, incomplete multi-guard implementation)

**1. [ ] Update config/auth.php**
   - Add `user`, `employer`, `admin` guards pointing to `users` provider
   - Run `php artisan config:clear`

**2. [ ] Fix resources/views/layouts/navigation.blade.php**
   - Replace `Auth::guard('user')->check()` → `session('active_role') === 'user' || (auth()->user()?->role === 'user')`
   - Fix all 3 role checks (user/employer/admin)
   - Run `php artisan view:clear`

**3. [ ] Test employer dashboard**
   - Access `/employer/dashboard`
   - Verify no auth guard error
   - Test role switcher dropdown

**4. [ ] Complete role switching (if needed)**
   - Check RoleSwitchController + GuardedSessionMiddleware
   - Add multi-cookie logic if required

**5. [ ] Clear caches**
   - `php artisan config:clear && php artisan route:clear && php artisan view:clear`

**6. [ ] Final verification**
   - Test all role dashboards (user/employer/admin)
   - Verify navigation works across roles

**Progress: 2/6 steps complete** (config/auth.php updated, navigation.blade.php fixed)

## Commands to run after each step:
```bash
php artisan config:clear
php artisan view:clear  
php artisan route:clear
```

